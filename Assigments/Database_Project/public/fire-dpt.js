
	

$('.edit').on('click', function(){
// 	$.ajax({url: baseurl + "/editP",
// 	data:{"username":$("#exampleInputEmail1").val(), "password":$("#exampleInputPassword1").val()},
// 	method:"POST",
// 	dataType:"json"}).done()
//$.when(ajax(this)).done();
// return;
	document.cookie = 'pid ='+this.parentElement.parentElement.id;
	
	// //console.log($.session.get('Pid'));
	// console.log(this.parentElement.parentElement.id);
	$.ajax({url: baseurl + "/editPersonnel",
	data:{"id":this.parentElement.parentElement.id},
	method:"GET",
	dataType:"json"}).done(function(){

	})


	console.log('hi');
	return;

 })

function ajax(x){
	$.ajax({url: baseurl + "/editPersonnel",
	data:{"id":x.parentElement.parentElement.id},
	method:"GET",
	dataType:"json"}).done(function(){

	})

}

$('.select').on('click',function(){
	console.log(this)
	console.log('yooo')
	document.cookie = 'sid ='+this.parentElement.parentElement.id;
	
})
$('.editE').on('click',function(){
	document.cookie = 'eid ='+this.parentElement.parentElement.id;
	
	
	console.log(this.parentElement.parentElement.id)
	console.log('hi')
})