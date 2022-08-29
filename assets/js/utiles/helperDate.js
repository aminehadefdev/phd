

class helperDate{
    static padTo2Digits(num) {
        return num.toString().padStart(2, '0');
    }
    static monthNames(id){
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        return monthNames[id]
    }
}

export default helperDate