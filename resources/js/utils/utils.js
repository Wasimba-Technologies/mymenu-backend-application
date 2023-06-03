import useAuth from "../composables/auth";
import {inject} from "vue";
import {ABILITY_TOKEN, useAbility} from "@casl/vue";

function greeting(){
    const myDate = new Date();
    const hrs = myDate.getHours();

    let greeting;

    if (hrs < 12)
        greeting = 'Good Morning';
    else if (hrs >= 12 && hrs <= 17)
        greeting = 'Good Afternoon';
    else if (hrs >= 17 && hrs <= 24)
        greeting = 'Good Evening';

    return greeting
}

function getStrMonth(date){
    let month = date.getMonth()+1
    return month >= 10 ? month : "0"+month
}

function getStrDate(dateObj){
    let date = dateObj.getDate()
    return date >= 10 ? date : "0"+date
}

function getStrYesterday(dateObj){
    let yesterday = dateObj.setDate(dateObj.getDate() - 1);
    let date = new Date(yesterday).getDate()
    return date >= 10 ? date : "0"+date
}
function getStrTomorrowDate(dateObj){
    let yesterday = dateObj.setDate(dateObj.getDate() + 1);
    let date = new Date(yesterday).getDate()
    return date >= 10 ? date : "0"+date
}

// const {can} = useAbility()
// const {logout} = useAuth()
// const has_perm = async (perm) => {
//     await getAbilities()
//     if (!can(perm)) {
//         await logout()
//     }
// }

function numFormat(num){
    return new Intl.NumberFormat().format(num)
}

const utils = {
    // has_perm,
    greeting,
    numFormat,
    getStrDate,
    getStrMonth,
    getStrYesterday,
    getStrTomorrowDate,
}

export default utils;
