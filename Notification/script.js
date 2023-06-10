const button=document.querySelector("button")

button.addEventListener("click",()=>{
    Notification.requestPermission().then(perm=>{
        if(perm==="granted"){
            const notification=new Notification("",{
                body:"Tasks not done!!!",
                data:{hello:"world"},
                icon:"logo.png",
                tag:"reminder",
            })
            notification.addEventListener("error",e=>{
                console.log(e)
            }) 
        }
    })
})
let notification
let interval
document.addEventListener("visibilitychange",()=>{
    if(document.visibilityState==="hidden"){
      const leaveDate=new Date()
       interval= setInterval(()=>{
           notification = new Notification("You have not completed all the tasks!!!",{
                body:`you have been gone for ${Math.round((new Date()-leaveDate)/1000)}secounds`,
                icon:"logo.png",
                tag:"come back"
    
            })
        },100)
    }
else{
if(interval) clearInterval(interval)
if(notification)notification.close()
}
})