function changeFoto(el1, el2)
{
  var img1 = new Image();
  var img2 = new Image();
  img1.src = document.images[el2].src;
  img2.src = document.images[el1].src;
  document.images[el1].src = img1.src;
  document.images[el2].src = img2.src;

 // document.images["Foto1"].width = 999;
}
function changeSize()
{
  var wid = document.getElementById('w');
  let hei = document.getElementById('h');
  var i;
  var elements = document.getElementsByName('rad');

  for (i=0; i<elements.length; ++i)
  {
    if (elements[i].checked)
    {break;}
  }

  if (i == 3)
  {
    alert('Ви забули обрати картинку!');
  }

  if (isNaN( wid.value) == false && isNaN(hei.value) == false)
   {
      document.images[elements[i].value].width = wid.value;
      document.images[elements[i].value].height = hei.value;
   }
  else alert('Розмір задають в цифрах!');
}
