<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Factory cho seeding/test
use Illuminate\Foundation\Auth\User as Authenticatable; // Base User của Laravel (Auth)
use Illuminate\Notifications\Notifiable; // Hỗ trợ notifications
use App\Models\Order; // Quan hệ đơn hàng

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Các thuộc tính cho phép gán hàng loạt (mass assignable).
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'balance',
    ];

    /**
     * Các thuộc tính ẩn khi serialize (JSON/array).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Kiểu ép (cast) cho thuộc tính.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Tự cast sang Carbon
            'password' => 'hashed',            // Tự hash password khi set
        ];
    }

    // ===== Getter/Setter thủ công cho các trường =====
    public function getId(){ 
        return $this->attributes['id']; 
    }
    public function setId($id) { 
        $this->attributes['id'] = $id; 
    }

    public function getName(){ 
        return $this->attributes['name']; 
    }
    public function setName($name) { 
        $this->attributes['name'] = $name;
    }

    public function getEmail(){ 
        return $this->attributes['email']; 
    }
    public function setEmail($email){
        $this->attributes['email'] = $email;
    }

    public function setPassword($password) { 
        $this->attributes['password'] = $password; // Lưu ý: đã có cast 'hashed'
    }

    public function getRole() { 
        return $this->attributes['role']; 
    }
    public function setRole($role) { 
        $this->attributes['role'] = $role; 
    }

    public function getBalance(){ 
        return $this->attributes['balance']; 
    }
    public function setBalance($balance) { 
        $this->attributes['balance'] = $balance; 
    }

    public function getCreatedAt(){
        return $this->attributes['created_at'];
    }
    public function setCreatedAt($createAt) { 
        $this->attributes['created_at'] = $createAt; 
    }

    public function getUpdatedAt() { 
        return $this->attributes['balance']; // ⚠️ Chú ý: trả về 'balance' có thể là nhầm lẫn so với 'updated_at'
    }
    public function setUpdatedAt($updatedAt) { 
        $this->attributes['updated_at'] = $updatedAt; 
    }

    // ===== Quan hệ =====
    public function orders(){
        return $this->hasMany(Order::class); // Một user có nhiều order
    }

    // Getter/Setter cho quan hệ (không chuẩn Eloquent, nhưng giữ nguyên logic)
    public function getOrders(){
        return $this->orders;
    }
    public function setOrders($orders){
        $this->orders = $orders;
    }
}
