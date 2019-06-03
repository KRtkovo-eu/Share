/*
Verze s animac� pomoc� JQuery
=============================

SLIDE VERSION
TYP 0: skryje prvek
TYP 1: zobraz� prvek
TYP 2: pokud je prvek skryt�, tak se zobraz� a naopak

FADE VERSION
TYP 3: skryje prvek
TYP 4: zobraz� prvek
TYP 5: pokud je prvek skryt�, tak se zobraz� a naopak

pou�it�: onclick="javascript:hideShow('ID PRVKU',TYP);"
*/


function hideShow(idElem,typ){
 el=document.getElementById(idElem).style;
 switch (typ) { 
  case 0:
   $('#'+idElem).slideUp('slow', function() {
    el.display='none';
   });
   break;
  case 1:
    $('#'+idElem).slideDown('slow', function() {
    el.display='block';
   });
   break;
  case 2:
   if (el.display=='block') {
     hideShow(idElem,0);
   }
   else hideShow(idElem,1);
   break;
  case 3:
   $('#'+idElem).fadeOut('slow', function() {
    el.display='none';
   });
   break;
  case 4:
    $('#'+idElem).fadeIn('slow', function() {
    el.display='block';
    });
   break;
  case 5:
   if (el.display=='block') {
     hideShow(idElem,3);
   }
   else hideShow(idElem,4);
   break;
  case 6:
   $('#'+idElem).animate({
    width: 'hide'
   }, 1000, function() {
    el.display='none';
  });
   break;
  case 7:
    $('#'+idElem).animate({
    width: 'show'
   }, 1000, function() {
    el.display='block';
  });
   break;
  case 8:
   if (el.display=='block') {
     hideShow(idElem,6);
   }
   else hideShow(idElem,7);
   break;
 }
}