<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Reset extends Mailable
{
  use Queueable, SerializesModels;

  protected $users;
  protected $user_id;
  protected $user_name;

  public function __construct($users,$user_id,$user_name)
  {
    $this->users = $users;
    $this->user_id = $user_id;
    $this->user_name = $user_name;
  }
 
  public function build()
  {
    return $this->from('info@flip-travel.com')
      ->subject('【FLIP】パスワード再発行申請')
      ->view('contact.reset')
      ->with([
        'users' => $this->users,
        'user_id' => $this->user_id,
        'user_name' => $this->user_name,
      ]);
  }
}
