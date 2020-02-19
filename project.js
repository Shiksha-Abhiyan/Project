var now = new Date();
var days = new Array(
'Sunday','Monday','Tuesday','Wednesday','Thrusday','Friday','Saturday');
var months = new Array(
'Janurary','February','March','April','May','June','July','August','September','October','November');
today = days[now.getDay()] + ", " +
months[now.getMonth()] + " " +
now.getDate() + ", " +
now.getFullYear();
document.write(today);

{
var day= d.getDate();
var month=  d.getMonth() +1;
var year= d.getFullYear();
document.write("<br>" + day + "/" + month + "/" + year + "<br>")

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
}