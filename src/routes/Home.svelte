<script>
    import CarElement from "../components/CarElement.svelte";
    import CarListSort from "../components/CarListSort.svelte";
    import Loader from "../components/Loader.svelte";

    async function getCars(){
        const response = await fetch("./backend/getCars.php")
        const data = await response.json()
        cars_array = data.cars
        cars_array.sort((a, b)=>{return a.price - b.price})
        return data.cars
    }
    const cars = getCars()
    let cars_array

    let sort_option = "lp"
    async function carsSort(e){
        sort_option = e.target.value
        if(sort_option=="lp"){
            cars_array.sort((a, b)=>{return a.price - b.price})
        }else if(sort_option=="hp"){
            cars_array.sort((a, b)=>{return b.price - a.price})
        }else if(sort_option=="nf"){
            cars_array.sort((a, b)=>{return b.year - a.year})
        }else if(sort_option=="of"){
            cars_array.sort((a, b)=>{return a.year - b.year})
        }
    }
    
</script>

<section class="text-gray-400 bg-gray-900 body-font overflow-hidden">
    <div class="container px-5 py-24 mx-auto">
            {#await cars}
                <Loader/>
            {:then}
                <div class="flex flex-col text-center w-full mb-10">
                    <h1 class="md:text-5xl sm:text-4xl text-3xl font-medium title-font mb-4 text-white">OUR CARS</h1>
                    <CarListSort carsSort={carsSort}/>
                </div>
                <div class="flex flex-wrap -m-4">
                    {#key sort_option}
                        {#each cars_array as car, i}
                            <CarElement id={car.id_cars} name={car.brand + " " + car.model} year={car.year} price={car.price} url={car.url}/>
                        {/each}
                    {/key}
                </div>
            {/await}
    </div>
</section>