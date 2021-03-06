<?php
    class DishesService {

        private $dish_dao;

        public function __construct() {
            $this->dish_dao = new DishesDao();
        }

        public function get_dishes(){
          $dishes = $this->dish_dao->get_all();
          foreach ($dishes as $idx => $dish){
            $dishes[$idx]['delete_dish'] = '<a class="btn btn-xs btn-outline red" onclick="Dishes.delete_dish('.$dish['id'].')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Delete</a>';
            $dishes[$idx]['finish_dish'] = '<a class="btn btn-xs btn-outline red" onclick="Dishes.finish_dish('.$dish['id'].')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Finish</a>';
            $dishes[$idx]['add_dish'] = '<a class="btn btn-info" onclick="Dishes.add_to_cart('.$dish['id'].')"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i> Add to Cart</a>';
          }

          return $dishes;
        }

        public function delete_dish($dish_id){
          $this->dish_dao->delete_by_id((int)$dish_id);
        }

        public function add_dish($dish){
          $user = [
            //polje iz baze => polje iz forme
            'email' => $dish['email'],
            'password' => $dish['password'],
            'type' => 'customer'
          ];

          $user_dao = new UserDao();
          $user_id = $user_dao->add_user($user);

          $dish = [
            'name' => $dish['name'],
            'price' => $dish['price'],
            'status' => $dish['status']
          ];

          $this->dish_dao->add($dish);
        }

        public function add_to_cart($dish){ 
          $this->dish_dao->add($dish);
        }


    }
