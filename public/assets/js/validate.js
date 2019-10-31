

$(() => {
    const TOKEN = $('meta[name=csrf-token]').attr('content');
    $.validator.addMethod("greaterThan", function(a, b, c) {
        return a.length > c;
    });

    $.validator.addMethod("squareFeet", function(a, b, c) {
        return parseInt(a) > c;
    });

    $.validator.addMethod("validateSelect", function(val, ele, arg) {
            return arg !== val;
    });

    $.validator.addMethod("validateExtension", function(value, ele) {
        let val ;

        if($(ele).val()) {
            val = $(ele).val() ;
        }

        else {
             val = $('input[name="old_thumbnail"]').val() ;
        }

            switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
            case 'jpeg': case 'jpg': case 'png' : case 'gif':
                return true;
            default:
                $(this).val('');
                return false;
        }
    });

    $.validator.addMethod('time_validation', function(value, element, param) {
        let start_time = parseInt($('select[name="open_house[start_time][]"]').val());
        let end_time = parseInt($('select[name="open_house[end_time][]"]').val());
        return (start_time >= end_time)  ? false : true ;
    },);

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

    $('input[name="baths"], input[name="bedrooms"], input[name=rent], input[name=square_feet]').inputFilter(function(value) {
        return /^\d*$/.test(value);
    });

    // Add Listing Form Validations
   $('#listing-form').validate({
       rules: {
           street_address: "required",
           display_address: "required",
           neighborhood_id: "required",
           bedrooms: "required",
           baths: "required",
           rent : {
               required: true,
               greaterThan: 0
           },

           square_feet: {
               required: true,
               squareFeet: 0
           },
           availability: {
               required: true,
               validateSelect: true
           },
           building_type: {
               required: true,
               validateSelect: true
           },
           "open_house[start_time][]": {
               validateSelect: true,
               time_validation : $('select[name="open_house[end_time][]"]')
           },

           "open_house[end_time][]": {
               validateSelect: true,
               time_validation : $('select[name="open_house[start_time][]"]')
               },

           thumbnail: {
               required: ($('input[name="old_thumbnail"]').val()) ? false : true,
               validateExtension: 'thumbnail'
           },

           description : "required",
           name : "required",
           phone_number: "required",
           email: "required",
           user_id : "required"
       },

       messages: {
           street_address: {
               required: "Street address is required."
           },
           display_address: {
               required: "Display address is required."
           },
           neighborhood_id: {
               required: "Neighborhood is required."
           },
           bedrooms: {
               required: "Bedroom is required."
            },
           baths: {
               required: "Bath is required."
           },
           rent: {
               required: "Rent is required.",
               greaterThan: "Rent must be greater than 0"
           },
           square_feet: {
               required: "Square feet is required.",
               squareFeet: "Square feet must be greater than 0"
           },
           availability: {
               required: "Select Availability.",
               validateSelect: "Select any one option."
           },

           building_type: {
               required: "Select Listing Type.",
               validateSelect: "Select any one option."
           },

           'open_house[start_time][]': {
               validateSelect: "Select any one option.",
               time_validation :  "Start Time should be smaller than end time."
           },

           'open_house[end_time][]': {
               validateSelect: "Select any one option.",
               time_validation :  "End Time should be greater than start time."
           },

           thumbnail: {
               required: "Thumbnail is required.",
               validateExtension: "Choose valid thumbnail file.",
           },

           description: {
               required: "Description is required."
           },
           name: {
               required: "Name is required."
           },
           phone_number: {
               required: "Phone number is required."
           },
           email: {
               required: "Email is required."
           },
           user_id: {
               required: "Owner is required."
           },
       },
       errorPlacement: function(error, element) {
           if ( element.attr("name") === "thumbnail" )
           {
               error.insertAfter("#error-message");
           }
           else
           {
               error.insertAfter(element);
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

    // Neighborhood Search Form Validations
    $('#search').validate({
        rules: {
            neighborhoods: {
                required :  true
            }
        },

        messages: {
            neighborhoods: {
                required : 'neighborhood is required',
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
            license_number: {
            required:true,
            remote: {
                    headers: {
                        'X-CSRF-TOKEN': TOKEN
                    },
                    url: "/verify-license",
                    type: "post",
                }
            },
            email: {
                required: true,
                email: true,
                remote: {
                    headers: {
                        'X-CSRF-TOKEN': TOKEN
                    },
                    url: "/verify-email",
                    type: "post",
                }
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
            license_number: {
                required: "License number is required.",
                remote: "License already taken",
            },
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
                remote: "Email already taken",
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
            remote: {
                headers: {
                    'X-CSRF-TOKEN': TOKEN
                },
                url: "/verify-email",
                type: "post",
            }
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
              remote: "Email already taken.",
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
          email: true,
        }
      },

      messages: {
        email: {
          required: "Email is required.",
          email: "Enter a valid Email.",
        }
      }
    });

    // Forgot Password
    $('#forgot-password').validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },

        messages: {
            email : {
                required: 'Email should be required.',
                email: "Invalid email enter"
            }
        }
    });

    // Reset Password
    $('#reset-password').validate({
        rules: {
            email: {
                required: true,
                email: true
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
            email : {
                required: 'Email should be required.',
                email: "Invalid email enter"
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

    // Contact_us Form Validations
    $('#contact_us_form').validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
            },
            phone_number: {
                required: true,
            },
            comment: {
                required: true,
            },
        },

        messages: {
            name: {
                required: "Name is required.",
            },
            email: {
                required: "Email is required.",
            },
            phone_number: {
                required: "Phone Number is required.",
            },
            comment: {
                required: "Message is required.",
            },
        }
    });

});
