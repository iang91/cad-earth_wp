jQuery(function ($) {
    /* GOOGLE MAP SCROLLING FIX */
	   $(".gmap-fix iframe").after('<div class="map_overlay" onClick="style.pointerEvents=\'none\'"></div>');

    /* OPEN SOCIAL IN NEW TAB */
        $(".et-social-icon a").attr('target', '_blank');

var input = document.querySelector('body').innerHTML;

        // better to abstract the process and create a generic method "replaceHtmlContent"
// which could be used in multiple contexts
function replaceHtmlContent(str, match, replaceFn) {
    // we use the "g" and "i" flags to make it replace all occurrences and ignore case
    var re = new RegExp(match, 'gi');
    // this RegExp will match any char sequence that doesn't contain "<" or ">"
    // and that is followed by a tag
    return str.replace(/([^<>]+)(?=<[^>]+>)/g, function(s, content){
      return content.replace(re, replaceFn);
    });
  }
  
  
  // and create another method specific to our use case
  function wrapUiMatch(src, match) {
    return replaceHtmlContent(src, match, function(str){
        
        //console.log(match)

$(document).ready(function(){

    document.querySelectorAll('div').forEach((e,i,a)=>{
        let text = e.textContent
        let result = text.includes(match)

     if(result){
     //   console.log(e)
     }


    })
//console.log($(`:contains('${match}'))`))
    
});
      return '<span class="ui-match">'+ str +'</span>';

    });
  }
  
  
  // so later we can use it like this
  var output = wrapUiMatch(input, '™');


  var words = [
    "CAD-Earth",
    "either"
];

$('.brand_tag .et_pb_module_header').html(function(_,html) {
    var reg = new RegExp('('+words.join('|')+')','gi');


   if(words.includes('CAD-Earth')){
    return html.replace(reg, '<span class="first">CAD</span><span class="sec">-EARTH</span>', html)
} else{
    return html.replace(reg, '<span class="red">$1</span>', html)

}



});
  


$('.move_first').insertBefore($('.feat_card_sty .dp-dfg-item:first-child'))

/* equal height rows */
/*
let priceTables = document.querySelectorAll('.feat_card_sty .dp-dfg-item')

$(document).ready(function(){
  setTimeout(() => {
   tableItems(priceTables, 'entry-summary')


  }, 1700);



})*/

  

function sleceArray(ele){
let itm =  document.querySelectorAll(ele)

let colNum = 3
let numRow = itm.length/colNum


for (let index = 0; index < numRow; index++) {

  const element = index;
  let arrN = Array.from(itm).slice((colNum*index), colNum * (index+1))
//  return arrN
setTimeout(() => {

  
// tableItems(arrN, 'entry-summary')
//console.log(arrN)
arElT(arrN)

}, 700);

}

}
sleceArray('.feat_card_sty .dp-dfg-item')



$('.table_pr_sty .et_pb_pricing_table').each(function(){
     
  $(this).find('.et_pb_frequency').insertAfter($(this).find('.et_pb_pricing'))
  
  })

$(document).ready(function(){
  //setTimeout(() => {
  
sleceArray('.table_pr_sty .et_pb_pricing_table')

//  }, 3700);



})
/*
$('.table_pr_sty .et_pb_pricing_table').each( function(){

sleceArray($(this))

})*/




 // console.log(elmAeerIt)

function arElT(eee){
/*
  eee.forEach((e,inx,arr)=>{
    console.log(inx)
  })*/

  let object = eee
  let aaa = []
  for (const key in object) {
    let indsx = key
    if (Object.hasOwnProperty.call(object, key)) {
      const element = object[key]; 

      Array.from(element.children).map((ell,i,a)=> {
        ell.classList.add('height-eq')
        ell.setAttribute('data-ind', `-el-${i}`)
        ell.setAttribute('index', i)
        if(ell.getAttribute('index') === i.toString() ) {
        var myObj = 
    { 
      'id': ell.getAttribute('index'),
      'name': ell.getAttribute('data-ind'),   //your title variable  
      'height': ell.offsetHeight,
      'element': ell,   //your title variable  
  
  
  }
  aaa.push(myObj)
}
      })

      //object[key].classList.add('elem-'+key)
      //objectELEM(element.children)
     // aaa.push(element)
    }

  }
  //console.log(aaa)
  reducir(aaa)

}


function tableItems(itm, childrenE){

 
  /*
  let dsds = itm.map(ell=>{
   Array.from(ell.children).filter(el=>{
  
    var classNames = el.className.split(' ');    
    return classNames;
   })
  })*/
  
 //console.log( dsds )


/*
var aElements = itm;
var abElements = Array.prototype.filter.call(aElements, function(element, index, aElements) {

  var classNames = element.className.split(' ');  
  console.log(element)
  return classNames.indexOf('entry-summary') > -1;
});
console.log(abElements);
*/


itm.forEach((ele,index,arra) => {


  let arrCh = Array.from(ele.children).map((e,i,arr)=>{
    //console.log(arr)
    return arr.filter(item => {return item.classList.contains(childrenE)} ) 


    });
   // console.log(arrCh)
objectELEM(arrCh)


})
 /* let arrCh = Array.from(ele.children).map((e,i,arr)=>{
    return arr.filter(item => {return item.classList.contains(childrenE)} ) 


    });*/

}


function objectELEM(ELEM){
  var arr3 = [];

  for (const key in ELEM) {
  
              ELEM[key].map((ell, i)=>{ 
                   ell.classList.add('height-eq')
              ell.setAttribute('data-ind', `-el-${i}`)
              ell.setAttribute('index', i)
                if(ell.getAttribute('index') === i.toString() ) {
  
  var myObj = 
    { 
      'id': ell.getAttribute('index'),
      'name': ell.getAttribute('data-ind'),   //your title variable  
      'height': ell.offsetHeight,
      'element': ell,   //your title variable  
  
  
  }
  
  arr3.push(myObj);

                }
  
             })
  
      }


      reducir(arr3)
}


function getId(ss){
   
    let array = ss
    let myArra = []
     Object.entries(ss).forEach(e=>{
           e.map((ele,ind,arr)=>{
 
             myArra.push(array[ind])
 
           })
 
         })
 
        return myArra

 }

function reducir(objs ){

var result = objs.reduce(function(r, a) {
  r[a.id] = r[a.id] || [];
  r[a.id].push(a);
  return r;
}, Object.create(null));


order(result)

}



function order(ggg){ 



result = Object.values(ggg).map((a, index) =>{
return Math.max(...a.map(b => b.height));

 });

let heAr = result.filter(function (value) {
    return !Number.isNaN(value);
})

elemts = Object.values(ggg).map((a, index) =>{
 return a[0].name
 });

listTa = elemts.filter(item => item !== undefined)
console.log(listTa)
listTa.map((e, index) =>{ 

$('[data-ind="'+e+'"]').height(heAr[index])




}) 




 }



window.addEventListener('resize', function(event) {

$('.height-eq').addClass('heightAuto')
setTimeout(function(){
$('.height-eq').removeClass('heightAuto')
}, 500) 

//tableItems(priceTables)


}, true);


secAnim('.feat_card_sty .dp-dfg-items')
secAnim('.table_pr_sty .et_pb_pricing_table_wrap')
secAnim('.acc_col2')
secAnim('.download_list')

 
/* animation timming */
function secAnim(elem, classes) {

    let container = document.querySelectorAll(elem) 
    try {
        myIt = container
           
container.forEach(el => {
Array.from(el.children).forEach((e,ind,arr)=>{
            let amountNum = ind+300
            let $this = e
            let num = ind+1
          //let act = (classes === "scrolling") ? 'active' : 'disable'
                  $this.style.setProperty('--an-delay',   (amountNum * num) +"ms")

           /* setTimeout(function() {

                $this.setAttribute('status', classes)

            }, 300 * amountNum);*/

        })


})

        

    } catch(e){
        e
    }



}

firstWord('.firstWord .et_pb_module_header')

/* get first word */
function firstWord(el) {


   let element0 = document.querySelectorAll(el)

   try{

     target = element0
      target.forEach(e=>{

        let element = e;

        if (e.textContent.includes('//')) {

        separator = e.textContent.split('//')
        e.innerHTML = `<span class="light-font">${separator[0]}</span> ${separator[1]}`
        
       } 
   

    })

  }catch(err){
    err
}

 

}



$('.table_style .dataTables_paginate .next').text('Load More Features →')



jQuery(document).ready(function($) {

  $('.et_mobile_menu .menu-item-has-children > a').each( function(){
  
    $(this).before('<input class="toggle_m" type="checkbox" name="toggle" value="menu">')
  
  })
  $('.et_mobile_menu > li > a').after('<div class="separator"></div>');
  
  
  });

 
// Responsive table styles applied to tables with .data-table
 function getDomIndex (target) {
    return [].slice.call(target.parentNode.children).indexOf(target)
  }
// Collect all children
var $childrenEl = document.querySelectorAll(".pricing_table_e table :is(td,th)")

var $children = $childrenEl


objArr = []
for (let index = 0; index < $children.length; index++) {
  const element = $children[index];

  var myObj = 
  { 
    'id': getDomIndex(element),
    'element': element,   //your title variable  


}
objArr.push(myObj)
}


var result = objArr.reduce(function(r, a) {
  r[a.id] = r[a.id] || [];
  r[a.id].push(a);
  return r;
}, Object.create(null));


// for of
for (const record of Object.keys(result)) {

  if (record) {
   let myDiv = document.createElement('div')
   myDiv.classList.add('el-tab')
  result[record].map(e=>{
    let eleT = e.element.cloneNode(true)

if(  e.element.textContent != "" ){
  
  
  myDiv.append(eleT)


}

  })

document.querySelector('.pricing_table_e .et_pb_text_inner').appendChild(myDiv)
  }
}


});