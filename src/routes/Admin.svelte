<script>
    import Loader from "../components/Loader.svelte";
    import { getAccountType, displayMessage } from "../js/app";

    async function isLogged(){
        const data = await getAccountType()
        if(data.account_type != "admin") location.href = "./"
        return data.logged
    }
    const user = isLogged()

    async function getUsers(){
        const response = await fetch("./backend/getUsers.php")
        const data = await response.json()
        return data
    }
    const users = getUsers()

    async function changeUserType(user, i){
        const form_data = new FormData()
        form_data.append("id_users", user.id_users)
        form_data.append("account_type", document.getElementById("select" + i).value)
        
        const response = await fetch("./backend/changeUserType.php",{
            method: "POST",
            body: form_data,
            mode: "no-cors",
        })
        const data = await response.json()
        displayMessage(false, "Successfully changed " + user.login + "\'s user type")
        setInterval(()=>{
            location.reload()
        }, 1500)
    }
</script>

<section class="text-gray-400 bg-gray-900 body-font overflow-hidden">
    
    {#await user}
        <Loader/>
    {:then}
        <div class="container px-5 py-8 mx-auto">
            <div class="flex flex-col text-center w-full mb-10">
                <h1 class="sm:text-5xl text-4xl font-medium title-font mb-2 text-white">ADMIN</h1>
            </div>
            
            {#await users}
            <Loader/>
            {:then data}
                <div class="lg:w-1/2 w-full mx-auto overflow-auto">
                    <table class="table-auto w-full text-left whitespace-no-wrap">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800 rounded-tl rounded-bl">ID</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800">Username</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800">User type</th>
                                <th class="w-10 title-font tracking-wider font-medium text-white text-sm bg-gray-800 rounded-tr rounded-br"></th>
                            </tr>
                        </thead>
                        <tbody>
                            {#each data as user, i}
                                <tr>
                                    <td class="px-4 py-3">{user.id_users}</td>
                                    <td class="px-4 py-3">{decodeURIComponent(user.login)}</td>
                                    <td class="px-4 py-3 flex">
                                        <div class="relative">
                                            <select id={"select" + i} class="rounded border border-gray-700 focus:ring-2 focus:ring-green-900 bg-gray-900 appearance-none py-1 focus:outline-none focus:border-green-500 text-gray-200 pl-3 pr-10">
                                                {#if user.account_type == "mod"}
                                                    <option value="mod" selected>mod</option>
                                                    <option value="activateUser">activateUser</option>
                                                    <option value="user">user</option>
                                                {:else if user.account_type == "activateUser"}
                                                    <option value="mod">mod</option>
                                                    <option value="activateUser" selected>activateUser</option>
                                                    <option value="user">user</option>
                                                {:else if user.account_type == "user"}
                                                    <option value="mod">mod</option>
                                                    <option value="activateUser">activateUser</option>
                                                    <option value="user" selected>user</option>
                                                {/if}
                                            </select>
                                            <span class="absolute right-0 top-0 h-full w-10 text-center text-gray-600 pointer-events-none flex items-center justify-center">
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4" viewBox="0 0 24 24">
                                                    <path d="M6 9l6 6 6-6"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 w-10 text-center">
                                        <button on:click={()=>changeUserType(user, i)} class="bg-green-500 border-0 py-1 px-3 focus:outline-none hover:bg-green-600 rounded text-base text-white">Save
                                        </button>
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