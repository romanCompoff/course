$(document).ready(()=>{

   $('.wr .btn').on('click', function(e){

      e.preventDefault();
      var result = 0;
      $(this).closest('.wr').find('.test_list>div').each(function(){
         $(this).find('input')[0].checked ? result += 1 : false;
      });

      getCourses(result);
   });

   function getCourses(result = 1){
      lvl = Math.floor(result/5);
      lvl = lvl ? lvl : 1;
      $('.oneCourse').each(function(){
         if(this.dataset.level == lvl){
            $('#lvl-courses').append(this);
            return false;
         }
         $('#all-courses').append(this);

      });
      $('.coursesList').removeClass('d-none');
      $('.categoryList')[0].innerHTML = `<h4 id="result" style="text-align:center">Вы правильно ответили на ${result} из 25 вопросов.</h4>`;
      $(window).scrollTop($('#result').offset().top);
   }
})
