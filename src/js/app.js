//get account type and if user is logged
export async function getAccountType(){
    const response = await fetch("./backend/session.php")
    const data = await response.json()
    console.log(data);
    return data
}

//display message
export function displayMessage(err, data, root=null) {
    if(root==null) root = document.getElementsByTagName('main')[0]
    let msg_div = document.createElement('div');
    msg_div.className = "fixed m-auto w-full mt-2 transition-opacity duration-500 opacity-0 top-0 z-1";
    let msg = document.createElement('p')
    msg.className = "text-white block pt-2 pb-2 text-center text-lg font-bold w-full rounded m-auto"
    msg.classList.add(err ? "bg-red-600" : "bg-green-500")
    msg.innerText = data;
    msg_div.appendChild(msg);
    root.append(msg_div);
    setTimeout(() => {
        msg_div.classList.add("opacity-90");
        msg_div.classList.remove("opacity-0");
        setTimeout(() => {
            msg_div.classList.remove("opacity-90");
            msg_div.classList.add("opacity-0");
            setTimeout(() => { root.removeChild(msg_div) }, 500)
        }, 4000)
    }, 10)
}