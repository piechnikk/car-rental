<script>
    import Loader from "../components/Loader.svelte";
    import { getAccountType, displayMessage } from "../js/app";

    async function isLogged(){
        const data = await getAccountType()
        if(!data.logged) location.href = "./"
        return data.logged
    }

    async function getAllReservations(){
        const response = await fetch("./backend/getAllReservations.php")
        const data = await response.json()
        return data
    }
    const reservations = getAllReservations()

    async function updateReservation(id_reservations, i) {
        let select = document.getElementById("select" + i).value
        let start_time = document.getElementById("start_time" + i).value
        let end_time = document.getElementById("end_time" + i).value
        let data = new FormData()
        data.append("id_reservations", id_reservations)
        data.append("status", select)
        data.append("start_time", start_time)
        data.append("end_time", end_time)
        const response = await fetch("./backend/updateReservation.php", {
            method: "POST",
            body: data,
            mode: "no-cors",
        })
        await response.json()
        displayMessage(false, "Reservation updated", document.getElementsByTagName("main")[0])
        setInterval(()=>{
            location.reload()
        }, 3000)
    }
</script>

<section class="text-gray-400 bg-gray-900 body-font overflow-hidden">
    
    {#await isLogged()}
        <Loader/>
    {:then}
        <div class="container px-5 py-8 mx-auto">
            <div class="flex flex-col text-center w-full mb-10">
                <h1 class="sm:text-5xl text-4xl font-medium title-font mb-2 text-white">MOD</h1>
            </div>
            
            {#await reservations}
            <Loader/>
            {:then data}
                <div class="w-full mx-auto overflow-auto">
                    <table class="table-auto w-full whitespace-no-wrap text-center">
                        <thead>
                            <tr>
                                <th class="px-2 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800 rounded-tl rounded-bl">Car ID</th>
                                <th class="px-2 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800 rounded-tl rounded-bl">Model</th>
                                <th class="px-2 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800">User</th>
                                <th class="px-2 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800">Start</th>
                                <th class="px-2 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800">End</th>
                                <th class="px-2 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800">Status</th>
                                <th class="w-10 title-font tracking-wider font-medium text-white text-sm bg-gray-800 rounded-tr rounded-br"></th>
                            </tr>
                        </thead>
                        <tbody>
                            {#each data.reservate as reservation, i}
                                <tr>
                                    <td class="px-2 py-3">{reservation.id_cars}</td>
                                    <td class="px-2 py-3">{reservation.brand} {reservation.model}</td>
                                    <td class="px-2 py-3">{reservation.login}</td>
                                    <td class="px-2 py-3">
                                        <input id={"start_time" + i} value={reservation.start_time} style="color-scheme: dark;" type="date" name="start_time" class="rounded border border-gray-700 focus:ring-2 focus:ring-green-900 bg-transparent appearance-none py-1 focus:outline-none focus:border-green-500 text-white px-2 text-sm">
                                    </td>
                                    <td class="px-2 py-3">
                                        <input id={"end_time" + i} value={reservation.end_time} style="color-scheme: dark;" type="date" name="end_time" class="rounded border border-gray-700 focus:ring-2 focus:ring-green-900 bg-transparent appearance-none py-1 focus:outline-none focus:border-green-500 text-white px-2 text-sm">
                                    </td>
                                    <td class="px-2 py-3">
                                        <div class="flex justify-center items-center">
                                            <div class="relative">
                                                <select id={"select" + i} class="rounded border border-gray-700 focus:ring-2 focus:ring-green-900 bg-gray-900 appearance-none py-1 focus:outline-none focus:border-green-500 text-gray-200 pl-3 pr-10 text-sm">
                                                    {#if reservation.status == "waiting"}
                                                        <option value="waiting" selected>waiting</option>
                                                        <option value="accepted">accepted</option>
                                                        <option value="rejected">rejected</option>
                                                    {:else if reservation.status == "accepted"}
                                                        <option value="waiting">waiting</option>
                                                        <option value="accepted" selected>accepted</option>
                                                        <option value="rejected">rejected</option>
                                                    {:else if reservation.status == "rejected"}
                                                        <option value="waiting">waiting</option>
                                                        <option value="accepted">accepted</option>
                                                        <option value="rejected" selected>rejected</option>
                                                    {/if}
                                                </select>
                                                <span class="absolute right-0 top-0 h-full w-10 text-center text-gray-600 pointer-events-none flex items-center justify-center">
                                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4" viewBox="0 0 24 24">
                                                        <path d="M6 9l6 6 6-6"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-2 py-3 w-10 text-center">
                                        <button on:click={()=>updateReservation(reservation.id_reservations, i)} class="bg-green-500 border-0 py-1 px-3 focus:outline-none hover:bg-green-600 rounded text-base text-white">Update</button>
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