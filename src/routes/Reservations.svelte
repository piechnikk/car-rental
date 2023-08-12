<script>
    import Loader from "../components/Loader.svelte";
    import { getAccountType, displayMessage } from "../js/app";
    
    let mainDiv = document.getElementsByTagName("main")[0]

    async function isLogged(){
        const data = await getAccountType()
        if(!data.logged) location.href = "./"
        return data.logged
    }

    async function getReservations(){
        const response = await fetch("./backend/getReservations.php")
        const data = await response.json()
        data.reservations.forEach(reservation => {
            if(Date.parse(reservation.end_time) - Date.parse(new Date().toISOString().slice(0,10)) < 0 && reservation.status == "accepted"){
                displayMessage(true, "Return the car", mainDiv)
            }
        })
        return data
    }
    const reservations = getReservations()

    async function cancelReservation(id_reservations) {
        let data = new FormData()
        data.append("id_reservations", id_reservations)
        const response = await fetch("./backend/cancelReservation.php", {
            method: "POST",
            body: data,
            mode: "no-cors",
        })
        await response.json()
        displayMessage(false, "Reservation canceled", mainDiv)
        setInterval(()=>{
            location.reload()
        }, 2000)
    }

    async function returnCar(id_reservations) {
        let data = new FormData()
        data.append("id_reservations", id_reservations)
        const response = await fetch("./backend/returnCar.php", {
            method: "POST",
            body: data,
            mode: "no-cors",
        })
        await response.json()
        displayMessage(false, "Successfully returned the car", mainDiv)
        setInterval(()=>{
            location.reload()
        }, 2000)
    }

    function showQRCode(reservation) {
        let main = document.getElementsByTagName("main")[0]
        let container = document.createElement("div")
        container.id = "qr"
        container.className = "fixed w-full h-full bg-black bg-opacity-50"
        container.addEventListener("click",()=>{
            main.removeChild(container)
        })

        let qr = document.createElement("div")
        qr.className = "container mx-auto flex flex-col px-5 py-24 justify-center items-center"
        new QRCode(qr, JSON.stringify(reservation))

        container.appendChild(qr)
        main.appendChild(container)
    }
</script>

<section class="text-gray-400 bg-gray-900 body-font overflow-hidden">
    
    {#await isLogged()}
        <Loader/>
    {:then}
        <div class="container px-5 py-8 mx-auto">
            <div class="flex flex-col text-center w-full mb-10">
                <h1 class="sm:text-5xl text-4xl font-medium title-font mb-2 text-white">MY RESERVATIONS</h1>
            </div>
            
            {#await reservations}
            <Loader/>
            {:then data}
                <div class="lg:w-1/2 w-full mx-auto overflow-auto">
                    <table class="table-auto w-full text-left whitespace-no-wrap">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800 rounded-tl rounded-bl">Model</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800">Year</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800">Start</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800">End</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800">Status</th>
                                <th class="w-10 title-font tracking-wider font-medium text-white text-sm bg-gray-800 rounded-tr rounded-br"></th>
                            </tr>
                        </thead>
                        <tbody>
                            {#each data.reservations as reservation, i}
                                <tr>
                                    <td class="px-4 py-3">{reservation.brand} {reservation.model}</td>
                                    <td class="px-4 py-3">{reservation.year}</td>
                                    <td class="px-4 py-3">{reservation.start_time}</td>
                                    <td class="px-4 py-3">{reservation.end_time}</td>
                                    <td class="px-4 py-3">
                                        {#if reservation.status=="accepted"}
                                            <button on:click={()=>{showQRCode(reservation)}} class="text-green-600 cursor-pointer underline border-none">{reservation.status}</button>
                                        {:else if reservation.status=="ended"}
                                            {reservation.status}
                                        {:else}
                                            <p class="{reservation.status=="rejected" ? "text-red-600" : "text-white" }">{reservation.status}</p>
                                        {/if}
                                    </td>
                                    <td class="px-4 py-3 w-10 text-center">
                                        {#if reservation.status=="waiting"}
                                            <button on:click={()=>cancelReservation(reservation.id_reservations)} class="bg-red-600 border-0 py-1 px-3 focus:outline-none hover:bg-red-700 rounded text-base text-white">Cancel</button>
                                        {:else if reservation.status=="accepted"}
                                            <button on:click={()=>returnCar(reservation.id_reservations)} class="bg-green-500 border-0 py-1 px-3 focus:outline-none hover:bg-green-600 rounded text-base text-white">Return</button>
                                        {/if}
                                    </td>
                                </tr>
                            {/each}
                        </tbody>
                    </table>
                </div>
            {/await}
        </div>
    {/await}
    
</section>