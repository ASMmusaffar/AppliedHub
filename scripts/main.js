// ------------------------------------------------------------
// -----------------------------------------------CallFunctions
// ------------------------------------------------------------
setTime()
colorSelection(localStorage.getItem('selectedThemeColor')??'#3b82f6')
if(localStorage.getItem('selectedTheme')=='light'){
    document.body.classList.remove('darkTheme')
    document.getElementById('changeTheme').setAttribute('src','sources/moon.svg')
}else{
    document.body.classList.add('darkTheme')
    document.getElementById('changeTheme').setAttribute('src','sources/sun.svg')
}

// ------------------------------------------------------------
// ---------------------------------------------ThemeToggle
// ------------------------------------------------------------

document.getElementById('changeTheme').addEventListener('click',function(){
    document.body.classList.toggle('darkTheme');
    if(document.body.classList.contains('darkTheme')){
        document.getElementById('changeTheme').setAttribute('src','sources/sun.svg')
        localStorage.setItem('selectedTheme','dark')
    }
    else{
        document.getElementById('changeTheme').setAttribute('src','sources/moon.svg')
        localStorage.setItem('selectedTheme','light')
    }
})


// ------------------------------------------------------------
// ------------------------------------------------MenuToggle
// ------------------------------------------------------------

document.getElementById('sidebarButton').addEventListener('click',function(){
    document.querySelector('.sidebar').classList.toggle('hide')
    document.querySelector('.logo').classList.toggle('hide')
})


// ------------------------------------------------------------
// --------------------------------------------------Time
// ------------------------------------------------------------

function setTime(){
    document.querySelectorAll('.currentTime').forEach(currentTime=>{
        let Time = new Date;
        currentTime.innerHTML='Last refresh at '+Time.toDateString()+', '+Time.toLocaleTimeString()
    })
}


// ------------------------------------------------------------
// --------------------------------------Open ChangeThemeModel
// ------------------------------------------------------------

function changeThemeModel(){
    document.querySelectorAll('.selectThemeCon').forEach(selectThemeCon=>{
        selectThemeCon.style.display='flex'
    })
    document.querySelectorAll('.overlay').forEach(overlay=>{
        overlay.classList.remove('hide')
    })
}


// ------------------------------------------------------------
// ----------------------------------------------------SelectClor
// ------------------------------------------------------------

function colorSelection(clr){
    localStorage.setItem('selectedThemeColor',clr);
    let selectedColor=localStorage.getItem('selectedThemeColor')??'#3b82f6';

    // ----------------------------------------HideContainers
    document.querySelectorAll('.selectThemeCon').forEach(selectThemeCon=>{
        selectThemeCon.style.display='none'
    })
    document.querySelectorAll('.overlay').forEach(overlay=>{
        overlay.classList.add('hide')
    })

    // -----------------------------------------ChangeClrs
    document.querySelectorAll('.primary').forEach(primary=>{
        primary.style.color=selectedColor;
    })
    document.querySelectorAll('.bg-primary').forEach(primary=>{
        primary.style.background=selectedColor;
    })
    document.querySelectorAll('.icon-primary').forEach(primary=>{
        primary.style.color=selectedColor;
    })
    document.querySelectorAll('.b-l-primary').forEach(primary=>{
        primary.style.borderLeft=`10px solid ${selectedColor}`;
    })
    document.querySelectorAll('.b-primary').forEach(primary=>{
        primary.style.border=`3px solid ${selectedColor}`;
    })
    document.querySelectorAll('.hover-bg-primary').forEach(primary=>{
        primary.addEventListener('mouseover',()=>{
            primary.style.background=selectedColor;
        })
        primary.addEventListener('mouseout',()=>{
            primary.style.background='var(--black)';
        })
    })
    document.querySelectorAll('.hover-primary').forEach(primary=>{
        primary.addEventListener('mouseover',()=>{
            primary.style.color=selectedColor;
        })
        primary.addEventListener('mouseout',()=>{
            primary.style.color='var(--black)';
        })
    })

}


// ------------------------------------------------------------
// -------------------------------------------showHideContainer
// ------------------------------------------------------------

function showContainer(conName){
    document.querySelectorAll(conName).forEach((conName)=>{
        conName.style.display='flex';
    })
    document.querySelectorAll('.addNewBatch').forEach((conName)=>{
        conName.classList.remove('hide')
    })
    document.querySelectorAll('.overlay').forEach(overlay=>{
        overlay.classList.remove('hide')
    })
}
function hideContainer(conName){
    document.querySelectorAll(conName).forEach((conName)=>{
        conName.style.display='none';
    })
    document.querySelectorAll('.addNewBatch').forEach((conName)=>{
        conName.classList.add('hide')
    })
    document.querySelectorAll('.overlay').forEach(overlay=>{
        overlay.classList.add('hide')
    })
}