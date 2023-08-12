<script>
    import Loader from "../components/Loader.svelte";
    import { getAccountType, displayMessage } from "../js/app";

    async function isLogged(){
        const data = await getAccountType()
        if(data.logged) location.href = "./"
        return data.logged
    }

    async function login(e){
        const mainDiv = document.getElementsByTagName("main")[0]
        e.preventDefault()
        let user_data = {
            login: encodeURIComponent(e.target[0].value),
            password: encodeURIComponent(e.target[1].value),
        }
        if(user_data.login.length == 0 || user_data.password.length == 0) {
            displayMessage(true, "Username and password cannot be empty", mainDiv)
            return
        }
        const response = await fetch("./backend/login.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(user_data),
                })
        const data = await response.json()
        if(data.logged){
            displayMessage(false, "Successfully logged in", mainDiv)
            setInterval(()=>{
                location.href = "./"
            }, 1000)
        }else{
            displayMessage(true, "Wrong username or password", mainDiv)
        }
    }

    const user = isLogged()

</script>

<section class="text-gray-400 bg-gray-900 body-font overflow-hidden">
    
    {#await user}
        <Loader/>
    {:then}
        <div class="container px-5 py-8 mx-auto">
            <div class="flex flex-col text-center w-full mb-10">
                <h1 class="sm:text-5xl text-4xl font-medium title-font mb-2 text-white">SIGN IN</h1>
            </div>
            
            <form on:submit={login} class="xl:w-2/5 lg:w-1/2 md:w-3/5 bg-gray-800 bg-opacity-50 rounded-lg p-8 flex flex-col md:mx-auto mx-6 mt-10 md:mt-0">
                <h2 class="text-white text-lg font-medium title-font mb-5">Sign in</h2>
                <div class="relative mb-4">
                    <label for="login" class="leading-7 text-sm text-gray-400">Username</label>
                    <input type="text" id="login" name="login" class="w-full bg-gray-600 bg-opacity-20 focus:bg-transparent focus:ring-2 focus:ring-green-900 rounded border border-gray-600 focus:border-green-500 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
                <div class="relative mb-4">
                    <label for="password" class="leading-7 text-sm text-gray-400">Password</label>
                    <input type="password" id="password" name="password" class="w-full bg-gray-600 bg-opacity-20 focus:bg-transparent focus:ring-2 focus:ring-green-900 rounded border border-gray-600 focus:border-green-500 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
                <input type="submit" value="Sign in" class="text-white bg-green-500 border-0 py-2 px-8 mt-2 focus:outline-none hover:bg-green-600 rounded text-lg"/>
            </form>
        </div>
    {/await}
    
</section>