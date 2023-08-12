<script>
    import Loader from "../components/Loader.svelte";
    import { getAccountType, displayMessage } from "../js/app";

    export let params

    async function isLogged(){
        const data = await getAccountType()
        return data.logged
    }
    const user = isLogged()

    
    let car
    async function getCar(){
        const response = await fetch("./backend/getCar.php",{
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({car_id: params.id}),
        })
        const data = await response.json()
        car = data.cars[0]
        return data.cars[0]
    }

    let price = 0
    let start_time = new Date().toISOString().slice(0,10)
    let end_time = ""
    async function calculate() {
        if(end_time!="") {
            if(Date.parse(end_time) - Date.parse(start_time)<0){
                price = 0
                end_time = ""
            }else{
                price = ((Date.parse(end_time) - Date.parse(start_time)) / 86400000 + 1) * car.price
            }
        }
    }
    
    let mainDiv = document.getElementsByTagName("main")[0]
    async function reservate(e) {
        e.preventDefault()
        if(end_time==""){
            displayMessage(true, "Wrong reservation end date", mainDiv)
            return
        }if(!await isLogged()){
            displayMessage(true, "You must be logged in", mainDiv)
            return
        }
        let data = new FormData()
        data.append("id_cars", car.id_cars)
        data.append("start_time", start_time)
        data.append("end_time", end_time)
        let URL = "./backend/reservate.php"
        let res = await fetch(URL, {
            method: "POST",
            body: data,
            mode: "no-cors",
        })
        res = await res.json()
        
        displayMessage(false, "Reservation waiting to be accepted by the moderator", mainDiv)
        setInterval(()=>{
            location.href = "./"
        }, 2000)
    }
</script>

<section class="text-gray-400 bg-gray-900 body-font overflow-hidden">
    
    {#await getCar()}
        <Loader/>
    {:then data}
        <div class="container px-5 py-8 mx-auto">
            <div class="flex flex-col text-center w-full mb-10">
                <h1 class="sm:text-5xl text-4xl font-medium title-font mb-2 text-white">CAR DETAILS</h1>
            </div>
            
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <img alt="Pictrue of {data.brand} {data.model} car." class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src={data.url}>
                <form on:submit={reservate} on:change={calculate} class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <h1 class="text-white text-3xl title-font font-medium mb-1">{data.brand} {data.model}</h1>
                    <div class="flex justify-between">
                        <div>
                            <p class="leading-relaxed">Year: {data.year}</p>
                            <div class="flex">
                                <span>Color: </span>
                                <div style="background-color: {data.color};" class="border-2 border-gray-800 ml-1 rounded-full w-6 h-6"></div>
                            </div>
                        </div>
                        <h2 class="flex text-lg tracking-widest text-green-500 title-font mb-1 font-medium px-2">{data.price}$/day</h2>
                    </div>
                    <div class="flex mt-1 items-center lg:justify-between justify-evenly pb-5 border-b-2 border-gray-800 mb-5">
                        <div class="relative mb-4">
                            <label for="start_time" class="leading-7 text-sm text-gray-400">Start</label>
                            <input bind:value={start_time} min={new Date().toISOString().slice(0,10)} style="color-scheme: dark;" type="date" name="start_time" id="start_time" class="rounded border border-gray-700 focus:ring-2 focus:ring-green-900 bg-transparent appearance-none py-2 focus:outline-none focus:border-green-500 text-white px-3">
                        </div>
                        <div class="relative mb-4">
                            <label for="end_time" class="leading-7 text-sm text-gray-400">End</label>
                            <input bind:value={end_time} min={start_time} style="color-scheme: dark;" type="date" name="end_time" id="end_time" class="rounded border border-gray-700 focus:ring-2 focus:ring-green-900 bg-transparent appearance-none py-2 focus:outline-none focus:border-green-500 text-white px-3">
                        </div>
                    </div>
                    <div class="flex">
                        <span class="title-font font-medium text-2xl text-white">${price}.00</span>
                        <!-- <button class="flex ml-auto text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded">Button</button> -->
                        <input class="flex ml-auto text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded cursor-pointer" type="submit" value="Reserve">
                    </div>
                </form>
            </div>
        </div>
    {/await}
</section>