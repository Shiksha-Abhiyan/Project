var currentTime = new Date()
var hours = currentTime.getHours()
var minutes = currentTime.getMinutes()
if (minutes < 10)
minutes = "0" + minutes
var suffix = "AM";
if (hours >=12){
	suffix ="PM";
	hours = hours - 12;
}
document.write(hours+":"+minutes,suffix)
