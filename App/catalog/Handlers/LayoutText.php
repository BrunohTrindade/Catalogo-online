<?php 
namespace App\Handlers;

class LayoutText
{
  private int $id;
  private string $textTitle;
  private string $textTitle2;
  private string $promo;

  public function getTextTitle() : string {
    return $this->textTitle;    
  }

  public function setTextTitle(string $text) : void {
    $this->textTitle2 = $text;
  }
  
  public function getTextTitle2() : string {
    return $this->textTitle;    
  }

  public function setTextTitle2(string $text) : void {
    $this->textTitle2 = $text;
  }

  public function getPromo() : string {
    return $this->promo;
  }

  public function setPromo(string $text) : void {
    $this->promo = $text;
  }
}