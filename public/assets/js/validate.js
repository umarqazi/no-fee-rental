

$(() => {

    $.validator.addMethod("greaterThan", function(a, b, c) {
        return a.length > c;
    });

    $.validator.addMethod("validateSelect", function(val, ele, arg) {
            return arg !== val;
    });

    $.validator.addMethod("confirmed", function(val, ele, arg) {
        console.log(val, parseInt($(arg).val()));
    });

    $.validator.addMethod("validateExtension", function(value, ele) {
        let val = $(ele).val();
        switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
            case 'jpeg': case 'jpg': case 'png':
                return true;
            default:
                $(this).val('');
                return false;
        }
    });

    (function($) {
        $.fn.inputFilter = function(inputFilter) {
            return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                }
            });
        };
    }(jQuery));

    $('input[name="baths"], input[name="bedrooms"], input[name=rent], input[name="unit"]').inputFilter(function(value) {
        return /^\d*$/.test(value);
    });

    // Add Listing Form Validations
   $('#listing_form').validate({
       rules: {
           street_address: "required",
           display_address: "required",
           city_state_zip: "required",
           neighborhood: "required",
           bedrooms: "required",
           baths: "required",
           description: "required",
           name: "required",
           email: "required",
           phone_number: "required",
           website: "required",
           available: {
               required: true,
               validateSelect: true
           },
           rent : {
               required: true,
               greaterThan: 0
           },
           unit: {
               required: true,
               greaterThan: 0
           },
           square_feet: {
               required: true,
               greaterThan: 0
           },
           thumbnail: {
               required: ($('input[name="old_thumbnail"]').val()) ? false : true,
               validateExtension: ($('input[name="old_thumbnail"]').val()) ? false : true,
           },
       },

       messages: {
           street_address: {
               required: "Street address is required."
           },
           display_address: {
               required: "Display address is required."
           },
           city_state_zip: {
               required: "City, Zip code, State any one is required."
           },
           neighborhood: {
               required: "Neighborhood is required."
           },
           bedrooms: {
               required: "Bedrooms is required."
            },
           baths: {
               required: "Baths is required."
           },
           description: {
               required: "Description is required."
           },
           name: {
               required: "Name is required."
           },
           email: {
               required: "Email is required."
           },
           phone_number: {
               required: "Phone number is required."
           },
           website: {
               required: "Website is required."
           },
           available: {
               required: "Select availability.",
               validateSelect: "Select any one option."
           },
           rent: {
               required: "Rent is required.",
               greaterThan: "Rent must be greater than 0"
           },
           unit: {
               required: "Unit is required.",
               greaterThan: "Unit must be greater than 0"
           },
           square_feet: {
               required: "Square feet is required.",
               greaterThan: "Square feet must be greater than 0"
           },
           thumbnail: {
               required: "Thumbnail is required",
               validateExtension: "Choose valid thumbnail file"
           }
       }
   });

   // Login Form Validations
    $('#login_form').validate({
       rules: {
           email: {
               required: true,
               email: true
           },
           password: {
               required: true,
               greaterThan: 8
           }
       },

        messages: {
           email: {
               required: "Email is required.",
               email: "Enter valid email."
           },
            password: {
               required: "Password is required.",
                greaterThan: "Password should be greater than 8 characters."
            }
        }
    });

    // Sign Up Form Validations
    $('#signup_form').validate({
        rules: {
            user_type: "required",
            first_name: "required",
            last_name: "required",
            phone_number: "required",
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                greaterThan: 8
            },
            password_confirmation: {
                required: true,
                equalTo: '#password',
            }
        },

        messages: {
            user_type: {
                required: "Select user type."
            },
            first_name: {
                required: "First name is required."
            },
            last_name: {
                required: "Last name is required."
            },
            email: {
                required: "Email is required.",
                email: "Please enter valid email"
            },
            phone_number: {
              required: "Phone number is requried."
            },
            password: {
                required: "Password is required.",
                greaterThan: "Password should be greater than 8 characters."
            },
            password_confirmation: {
                required: "Confirm password is required",
                equalTo: "Password not matched."
            },
        }
    });

    // Create User Form Validations
    $('#add_user').validate({
      rules: {
        user_type: "required",
        first_name: "required",
        last_name: "required",
        phone_number: "required",
        email: {
          required: true,
          email: true,
        },
      },
      messages: {
        user_type: {
                required: "Select user type."
            },
            first_name: {
                required: "First name is required."
            },
            last_name: {
                required: "Last name is required."
            },
            email: {
                required: "Email is required.",
                email: "Please enter valid email"
            },
            phone_number: {
              required: "Phone number is requried."
            },
      }
    });

    // Agent Invite Form Validation
    $('#agent_invite').validate({
      rules: {
        email: {
          required: true,
          email: true
        }
      },

      messages: {
        email: {
          required: "Email is required.",
          email: "Enter a valid Email.",
        }
      }
    });
});