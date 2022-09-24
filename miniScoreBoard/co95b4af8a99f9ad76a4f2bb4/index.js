let home = document.getElementById("home")
let guest = document.getElementById("guest")
let guestFoulCount = document.getElementById("gfoul")
let homeFoulCount = document.getElementById("hfoul")
let quarterCount = document.getElementById("half")
let homeScore = 0
let guestScore = 0
let periodCount = 0
let hfoul = 0
let gfoul = 0


// HOME SCORE BUTTONS
function hp1(){
    homeScore += 1
    home.innerText = homeScore
}
function hp2(){
    homeScore += 2
    home.innerText = homeScore
}
function hp3(){
    homeScore += 3
    home.innerText = homeScore
}

// GUEST SCORE BUTTONS
function gp1(){
    guestScore += 1
    guest.innerText = guestScore
}
function gp2(){
    guestScore += 2
    guest.innerText = guestScore
}
function gp3(){
    guestScore += 3
    guest.innerText = guestScore
}

// FOUL BUTTONS
function homeFoul(){
    hfoul += 1
    homeFoulCount.innerText = hfoul
}
function guestFoul(){
    gfoul += 1
    guestFoulCount.innerText = gfoul
}
// PERIOD BUTTON
function quarter(){
    periodCount += 1
    quarterCount.innerText = periodCount
}

// END BUTTON
function end(){
    homeScore = 0
    guestScore = 0
    periodCount = 0
    hfoul = 0
    gfoul = 0
    guest.innerText = guestScore
    home.innerText = homeScore
    quarterCount.innerText = periodCount
    homeFoulCount.innerText = hfoul
    guestFoulCount.innerText = gfoul
}