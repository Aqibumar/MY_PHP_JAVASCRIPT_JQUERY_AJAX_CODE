
<!-- Calculate Total Marks With Constructor Function-- >
<?php
//  class calculatetotalmarks{
//  public $english,$math,$marks,$urdu;
//     function __construct($english,$math,$urdu){
//     $this-> english = $english;
//     $this-> math = $math;
//     $this-> urdu = $urdu;
//     }
//     function totalmarks(){
//      $this->marks = $this->english +  $this->math + $this->urdu;
//      return $this->marks;
//     }
//     }
    ?>
 <-------------------------------------------------------->

 <!-- Calculate overall Grade With Constructor Function-- >
<?php
//  class calculateoverallgrade{
//  public $marks;
//     function __construct($marks){
//     $this-> marks = $marks;
//     }
//     function gradecalculation(){
//       if ($this->marks >= 280) {
//          return 'A*';
//       } elseif ($this->marks >= 250) {
//           return 'A';
//       } elseif ($this->marks >= 220) {
//           return 'B*';
//       } elseif ($this->marks >= 200) {
//           return 'B';
//       }elseif ($this->marks >= 190) {
//           return 'C';
//       }
//       elseif ($this->marks >= 150) {
//           return 'D';
//       }
//       else {
//           return 'F';
//       }
//     }
//    }

    ?>
 <-------------------------------------------------------->

 <!-- Calculate subject Grade by inheriting the calculateoverallgrade
 class constructor and properties and overloading the gradecalculation function-- >
<?php
//  class calculatesubjectgrade extends  calculateoverallgrade{
//     function gradecalculation(){
//       if ($this->marks >= 90) {
//          return 'A*';
//      } elseif ($this->marks >= 80) {
//          return 'A';
//      } elseif ($this->marks >= 70) {
//          return 'B*';
//      } elseif ($this->marks >= 60) {
//          return 'B';
//      }elseif ($this->marks >= 50) {
//          return 'C';
//      }
//      elseif ($this->marks >= 40) {
//          return 'D';
//      }
//      else {
//          return 'F';
//      }
//    }
//  }
    ?>
 <-------------------------------------------------------->

<!--Function of calculating marks and grade and subjgrade by using abstraction-->
 <?php
 abstract class calculatemarksanndgrade{
    abstract public static function totalmarks($english,$math,$urdu);
    abstract public static function overallgrade($totalmarks);
    abstract public static function subgrade($marks);
  }
  class totalmarkandgrade extends calculatemarksanndgrade{
   public static function totalmarks($english,$math,$urdu) : int {
         return $english + $math + $urdu ;
     }
   public static function overallgrade($totalmarks) : string {
       if ($totalmarks >= 280) {
           return 'A*';
       } elseif ($totalmarks >= 250) {
           return 'A';
       } elseif ($totalmarks >= 220) {
           return 'B*';
       } elseif ($totalmarks >= 200) {
           return 'B';
       }elseif ($totalmarks >= 190) {
           return 'C';
       }
       elseif ($totalmarks >= 150) {
           return 'D';
       }else {
           return 'F';}}

   public static function subgrade($marks) : string {
       if ($marks >= 90) {
           return 'A*';
       } elseif ($marks >= 80) {
           return 'A';
       } elseif ($marks >= 70) {
           return 'B*';
       } elseif ($marks >= 60) {
           return 'B';
       }elseif ($marks >= 50) {
           return 'C';
       }elseif ($marks >= 40) {
           return 'D';
       }else {
           return 'F';}}
 }
   ?>
<!-- --------------------------------------------------------------------- -->