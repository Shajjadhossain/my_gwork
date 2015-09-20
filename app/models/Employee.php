<?php


    class Employee extends Eloquent
    {
        protected $table = 'employees';
        public $source;
        private $errors;
        private $rules = array(
        'first_name' => 'required|alpha|min:3',
        'last_name'  => 'required',
        'email' => 'required|email|unique:employees', // required and must be unique in the employees table
        //'files' => 'required|mimes:jpeg,jpg,png'
        //'photo' => 'image|max:3000',
        //'photo' => 'mimes:jpg,jpeg,bmp,png'
        // .. more rules here ..
        //'password'         => 'required',
        //'password_confirm' => 'required|same:password'
        //'name'                  => 'required|between:4,16',
        //'email'                 => 'required|email',
        //'password'              => 'required|alpha_num|between:4,8|confirmed',
        //'password_confirmation' => 'required|alpha_num|between:4,8',
        );


        public function validate($data)
        {
            // make a new validator object
            $validate = Validator::make($data, $this->rules);
            // check for failure
            if ($validate->fails())
            {
                // set errors and return false
                $this->errors = $validate->errors();
                return false;
            }
            // validation pass
            return true;
        }
        public function errors()
        {
            return $this->errors;
        }
        //relation to another model/table
        /*public function user_profile()
        {
            return $this->hasOne('User_Profile');
        }*/
        public function scopeFreesearch($query, $value)
        {
            return $query->where('id','like', $value.'%')
                ->orWhere('first_name','like', $value.'%');
        }



    }

?>