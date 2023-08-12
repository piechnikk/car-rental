<script>
	import Tailwindcss from "./Tailwindcss.svelte";
	import Router from "svelte-spa-router";

	import Header from "./components/Header.svelte";
	import Footer from "./components/Footer.svelte";

	import Home from "./routes/Home.svelte";
	import Login from "./routes/Login.svelte";
  	import Register from "./routes/Register.svelte";
	import Admin from "./routes/Admin.svelte";
	import Reservations from "./routes/Reservations.svelte";
	import Mod from "./routes/Mod.svelte";
  	import CarDetails from "./components/carDetails.svelte";
	import NotFound from "./routes/NotFound.svelte";
</script>

<Tailwindcss />
<main>
	<Header />
	<Router
		routes={{
			"/": Home,
			"/reservations": Reservations,
			"/mod": Mod,
			"/login": Login,
			"/register": Register,
			"/admin": Admin,
			"/carDetails/:id": CarDetails,
			"*": NotFound,
		}}
	/>
	<Footer />
</main>

<style>
	main {
		padding: 0;
		margin: 0;
		min-width: 320px;
		min-height: 100%;
		display: flex;
		flex-direction: column;
		justify-content: space-between;
	}
</style>
