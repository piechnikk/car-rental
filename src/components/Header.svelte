<script>
    import MiniLoader from "../components/MiniLoader.svelte";
    import {getAccountType, displayMessage} from "../js/app.js";

    async function isLogged(){
        const data = await getAccountType()
        return data
    }
    const user = isLogged()

    async function logOut(){
        await fetch("./backend/logout.php")
        displayMessage(false, "Successfully logged out", document.getElementsByTagName("main")[0])
            setInterval(()=>{
                location.reload()
            }, 1000)
    }
</script>
<header class="text-white bg-gray-900 body-font">
    <div class="container mx-auto flex flex-wrap p-5 flex-col sm:flex-row items-center">
        <a href="./" class="flex title-font font-medium items-center text-white mb-4 sm:mb-0">
            <img src="./assets/car.png" alt="White car">
            <span class="ml-3 text-xl">Car-Rental</span>
        </a>
            {#await user}
            <div class="inline-flex sm:ml-8 sm:mt-0 mt-4 justify-center sm:justify-start">
                <MiniLoader/>
            </div>
                
            {:then response}
                {#if response.logged}
                <nav class="sm:mr-auto sm:ml-4 sm:py-1 sm:pl-4 sm:border-l sm:border-gray-700	flex flex-wrap items-center text-base justify-center">
                    {#if response.account_type=="admin"}
                        <a href="#/reservations" class="hover:text-white">My reservations</a>
                        <a href="#/mod" class="ml-5 sm:ml-3 md:ml-5 hover:text-white">Mod</a>
                        <a href="#/admin" class="ml-5 sm:ml-3 md:ml-5 hover:text-white">Admin</a>
                    {:else if response.account_type=="mod"}
                        <a href="#/reservations" class="hover:text-white">My reservations</a>
                        <a href="#/mod" class="ml-5 sm:ml-3 md:ml-5 hover:text-white">Mod</a>
                    {:else if response.account_type=="activateUser"}
                        <a href="#/reservations" class="hover:text-white">My reservations</a>
                    {:else}
                        <p class="text-red-500">Your account has not been activated</p>
                    {/if}
                    
                </nav>
                {/if}
            {/await}

        {#await user}
        <div class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
            <MiniLoader/>
        </div>
        {:then response} 
            {#if response.logged}
                <button on:click={logOut} class="inline-flex items-center bg-green-500 border-0 py-1 px-3 focus:outline-none hover:bg-green-600 rounded text-base sm:text-sm md:text-base mt-4 sm:mt-0">Log out
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1 sm:hidden md:block" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </button>
            {:else}
                <div class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
                    <a href="#/login" class="inline-flex items-center bg-green-500 border-0 py-1 px-3 focus:outline-none hover:bg-green-600 rounded text-base sm:text-sm md:text-base mt-4 sm:mt-0">Sign in
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1 sm:hidden md:block" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    <a href="#/register" class="inline-flex items-center bg-green-500 border-0 py-1 px-3 focus:outline-none hover:bg-green-600 rounded text-base sm:text-sm md:text-base mt-4 sm:mt-0 ml-3">Sign up
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1 sm:hidden md:block" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            {/if}
        {/await}
    </div>
</header>