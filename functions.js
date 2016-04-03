	ing_counter = 2;
	inst_counter = 2;

	function inputSelect(id,defaultV){
		e = document.getElementById(id);
		if (e.value == defaultV){
			e.setAttribute('value','');
		}
	}

	function upload(){
		document.getElementById('uploader').click();
		filename = document.getElementById('uploader').value;
	}

	function writeFileName(){
		length = document.getElementById('uploader').value.length;
		document.getElementById('filename').value = document.getElementById('uploader').value.slice(12,length);
	}

	function add_field(target, subtarget) 
	{
		if (target == 'ingredient'){
			counter = ing_counter;
		} else if (target == 'instruction'){
			counter = inst_counter;
		}

	var section = document.getElementById(target + 's'),
    input = document.createElement('input');
    input.id = target + counter;
    input.className = 'col-8';
	input.setAttribute('type', 'text');
	input.setAttribute('name', target + counter);
	section.appendChild(input);
	document.getElementById(target + counter).focus();


    input = document.createElement('input');
    input.id = target + '_' + subtarget + counter;
    input.className = 'col-3';
	input.setAttribute('type', 'text');
	input.setAttribute('name', target + '_' + subtarget + counter);
	section.appendChild(input);	

    br = document.createElement('br');
	section.appendChild(br);
		if (target == 'ingredient'){
			document.getElementById('ingredientnumber').value = counter;
		    ing_counter ++
		} else if (target == 'instruction'){
			document.getElementById('instructionnumber').value = counter;
		    inst_counter ++
		}

	};

var i=1;
var chosen = false;
var stars = 0;
var burl = null;

function starClick(stars){
	chosen = false;
	starHover(stars);
	chosen = true;
	document.getElementById('submit').style.visibility="visible";
	burl = document.getElementById('submit').href;
	burl = burl.substring(0, burl.length - 1) + stars;
	document.getElementById('submit').href = burl;
}

function starHover(stars){
	if (chosen == false){
		for(i=1; i <= 10; i++){
			z = document.getElementById(i);
			if (z.id > stars){
				if (z.id%2 == 0){
					z.style.background="url('imgs/star2right.png')";
				} else{
					z.style.background="url('imgs/star2left.png')";			
				}
			
			} else{
				if (z.id%2 == 0){
					z.style.background="url('imgs/starright.png')";
				} else{
					z.style.background="url('imgs/starleft.png')";			
				}
			}
		}
	}
}

vegetarianstat='off';
veganstat='off';
gfstat='off';

function hasClass(className) {
    return new RegExp(className).test(e[i].className);
}

function hasId(idName) {
	idName = idName.toLowerCase();
	idName2 = e[i].id.toLowerCase();
    return new RegExp('' + idName).test(idName2);
}



function filterBy(className){
	if (className == 'vegetarian'){
		if (vegetarianstat == 'off'){
			vegetarianstat = 'on';
		} else{
			vegetarianstat = 'off';
		}
	}

	if (className == 'vegan'){
		if (veganstat == 'off'){
			veganstat = 'on';
		} else{
			veganstat = 'off';
		}
	}

	if (className == 'gf'){
		if (gfstat == 'off'){
			gfstat = 'on';
		} else{
			gfstat = 'off';
		}
	}


	searchName = document.getElementById("searchName").value;
	e = document.getElementsByClassName('recipes');
		for (  i=0, l=e.length; i<l; ++i ){
			e[i].style.display = 'block';
			if (gfstat == 'on'){
				if (hasClass('gf') !== true){
				e[i].style.display = 'none';
				}
			}
			if (veganstat == 'on'){
				if (hasClass('vegan') !== true){
				e[i].style.display = 'none';
				}
			}
			if (vegetarianstat == 'on'){
				if (hasClass('vegetarian') !== true){
				e[i].style.display = 'none';	
				}
			}
			if (hasId(searchName) !== true && searchName != ' Search for:'){
				e[i].style.display = 'none';
			}
		}
}

function validation(thisform)
{
   with(thisform)
   {
      if(validateFileExtension(file, "valid_msg", "<br />This file type is not accepted. <br /> Please upload a different photo.",
      new Array("jpg","jpeg","gif","png","")) == false)
      {
         return false;
      }
      if(validateFileSize(file,1048576, "valid_msg", "Document size should be less than 1MB !")==false)
      {
         return false;
      }
   }
}

function validateFileExtension(component,msg_id,msg,extns)
{
   var flag=0;
   with(component)
   {
      var ext=value.substring(value.lastIndexOf('.')+1);
      for(i=0;i<extns.length;i++)
      {
         if(ext==extns[i])
         {
            flag=0;
            break;
         }
         else
         {
            flag=1;
         }
      }
      if(flag!=0)
      {
         document.getElementById(msg_id).innerHTML=msg;
         component.value="";
         component.style.backgroundColor="red";
         component.style.border="thin solid #000000";
         component.focus();
         return false;
      }
      else
      {
         return true;
      }
   }
}

function validateFileSize(component,maxSize,msg_id,msg)
{
   if(navigator.appName=="Microsoft Internet Explorer")
   {
      if(component.value)
      {
         var oas=new ActiveXObject("Scripting.FileSystemObject");
         var e=oas.getFile(component.value);
         var size=e.size;
      }
   }
   else
   {
      if(component.files[0]!=undefined)
      {
         size = component.files[0].size;
      }
   }
   if(size!=undefined && size>maxSize)
   {
      document.getElementById(msg_id).innerHTML=msg;
      component.value="";
      component.style.backgroundColor="#eab1b1";
      component.style.border="thin solid #000000";
      component.focus();
      return false;
   }
   else
   {
      return true;
   }
}
