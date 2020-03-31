

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
        } else {
             val = $('input[name="old_thumbnail"]').val() ;
        }

            switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
            case 'jpeg': case 'jpg': case 'png':
                return true;
            default:
                $(this).val('');
                return false;
        }
    });

    $.validator.addMethod("dateFormat", function(value, ele) {
        let rxDatePattern = /([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/;
        let check = value.match(rxDatePattern);
        if(check !== null) {
            return true;
        }
        else {
            return false;
        }
    });

    $.validator.addMethod('time_validation', function(value, element, param) {
        let start_time = parseInt($('select[name="open_house[start_time][]"]').val());
        let end_time = parseInt($('select[name="open_house[end_time][]"]').val());
        return (!(start_time >= end_time)) ;
    });

    $.validator.addMethod('date_validation', function(value, element, param) {
        let availability = $('input[name="availability"]').val();
        let open_house = $('input[name="open_house[date][]"]').val();console.log(open_house=='');
        return (open_house == '' || availability == '') ?  true : (open_house >= availability);
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

    $('input[name=free_months], input[name=cvc]').inputFilter(function(value) {
        return /^\d*$/.test(value);
    });

    // Add Listing Form Validations
   $('#listing-form').validate({
       rules: {
           street_address: {
               required: true,
           },
           display_address: "required",
           neighborhood: "required",
           bedrooms: "required",
           baths: "required",
           rent : {
               required: true,
               greaterThan: 0
           },

           availability: {
               required: true,
               validateSelect: true,
           },
           listing_type: {
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
           owner_id : "required",
       },

       messages: {
           street_address: {
               required: "Street address is required."
           },
           display_address: {
               required: "Display address is required."
           },
           neighborhood: {
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
               validateSelect: "Select any one option.",
               dateFormat: "Select Valid Date.",
           },

           listing_type: {
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
           owner_id: {
               required: "Owner is required."
           }
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

    // Create Password form
    $('#create-password').validate({
        rules: {
            password: {
                required: true,
                greaterThan: 8
            },
            password_confirmation: {
                required: true,
                equalTo: '#password'
            }
        },

        messages: {
            password: {
                required: "Password is required.",
                greaterThan: "Password should be greater than 8 characters"
            },
            password_confirmation: {
                required: "Password confirmation is required.",
                equalTo: "Password not match"
            }
        }
    });

    // Add building Form Validations
    $('#add_building').validate({
        rules: {
            neighborhood: {
                required: true,
            },
            street_address: {
                required: true,
                // remote: {
                //     headers: {
                //         'X-CSRF-TOKEN': TOKEN
                //     },
                //     url: "/owner/verify-address",
                //     type: "post",
                // }
            },
            email: {
                email: true,
                required: true,
            },
            username: {
                required: true
            },
            phone_number: {
                required: true
            },
            building_action: {
                required: true,
            },
            thumbnail: {
                required: true,
                validateExtension: 'thumbnail'
            },
        },

        messages: {
            neighborhood: {
                required: "Neighborhood is required.",
            },
            street_address: {
                required: "Street Address is required.",
            },
            building_action: {
                required: "Building action is required.",
            },
            email: {
                email: "Please enter a valid email.",
                required: "Email Action is required.",
            },
            username: {
                required: "User name is requried."
            },
            phone_number: {
                required: "Phone number is required."
            },
            thumbnail: {
                required: "Thumbnail is required.",
                validateExtension: "Choose valid thumbnail file.",
            },
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
                required : 'Neighborhood is required.',
            }
        },
        errorPlacement: function(error, element) {
            if ( element.attr("name") === "neighborhoods" )
            {
                error.insertAfter('#search-error-message');
            }
            else
            {
                error.insertAfter(element);
            }
        },
    });


    // Sign Up Form Validations
    $('#signup_form').validate({
        rules: {
            user_type: "required",
            first_name: "required",
            last_name: "required",
            phone_number: {
            required : true ,
           /* format: true ,
           */  },
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
              required: "Phone number is required."
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

    // Invited agent sign_up
    $('#invited_sign_up').validate({
        rules: {
            user_type: "required",
            first_name: "required",
            last_name: "required",
            phone_number: {
                required : true ,
                /* format: true ,
                */  },
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
                required: "Email is required.",
                email: "Please enter valid email"
            },
            phone_number: {
                required: "Phone number is required."
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
          remote: {
              headers: {
                  'X-CSRF-TOKEN': TOKEN
              },

              url: "/agent/validate-email",
              type: "post",
          },
        }
      },

      messages: {
        email: {
          required: "Email is required.",
          email: "Enter a valid Email.",
          remote: "User with this email already exists having some other user type."
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

    // Agent Inbox Rule
    $('#send-message').validate({
        rules: {
            message: {
                required: true,
            },
        },
        messages: {
            message: {
                required: "",
            },
        },

        errorPlacement: function(error, element) {
            if ( element.attr("name") === "message" )
            {
                error.css('display' , 'none') ;
            }
        },
    });

    // Review Request Rule
    $('#review-request').validate({
        rules: {
            message: {
                required: true,
            },
            email: {
                required: true,
                email: true,
                remote: {
                    headers: {
                        'X-CSRF-TOKEN': TOKEN
                    },
                    url: "/verify-renter",
                    type: "post",
                }
            },
        },
        messages: {
            message: {
                required: "Message is required.",
            },
            email: {
                required: "Email is required.",
                email: "Please enter valid email",
                remote: "Renter does not exist.",
            },
        },
    });

    // check availability Rules
    $('#check-availability').validate({
        rules: {
            username: {
                required: true
            },
            email: {
                required:true,
            },
            phone_number: {
                required: true
            },
            message: {
                required:true,
            },
        },

        messages: {
            username: {
                required: "User Name is required.",
            },
            email: {
                required: "Email is required.",
            },
            phone_number: {
                required: "Phone Number is required.",
            },
            message: {
                required: "Message is required.",
            },
        }
    });

    // Payment Checkout Form validations
    $('#stripe-checkout').validate({
        rules: {
            card_holder_name: {
                required: true
            },
            card_number: {
                required: true,
            },
            cvc: {
                required: true,
            },
            exp_month: {
                required: true,
            },
            exp_year: {
                required: true,
            }
        },

        messages: {
            card_holder_name: {
                required: "Card Holder Name is required"
            },
            card_number: {
                required: "Card Number is required"
            },
            cvc: {
                required: "CVC Number is required",
                maxLength: "CVC Not be greater than 3 numbers"
            },
            exp_month: {
                required: "Expiry month is required"
            },
            exp_year: {
                required: "Expiry year is required"
            }
        }
    });

    // Add Neighborhoods Form validations
    $('#add_neighborhood').validate({
        rules: {
            neighborhood_name: {
                required: true
            },
            neighborhood_content: {
                required: true,
            },
        },

        messages: {
            neighborhood_name: {
                required: "Name is required."
            },
            neighborhood_content: {
                required: "Content is required.",
            },
        }
    });

    // Add Add Event Form validations
    $('#add_event').validate({
        rules: {
            title: {
                required: true
            },
            start: {
                required: true,
            },

            end: {
                required: true,
            },
        },

        messages: {
            title: {
                required: "Event Title is required."
            },
            start: {
                required: "Start Date is required.",
            },
            end: {
                required: "End Date is required.",
            },
        }
    });

    // Get Started Form Validation
    $('#get_started').validate({
        rules: {
            'beds[]': {
                required: true
            },
            price: {
                required: true
            },
            move_in_date: {
                required: true
            },
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone_number: {
                required: true
            },
            description: {
                required: true
            }
        },
        messages: {
            move_in_date: "Move in date is required",
            price: "Budget is required",
            'beds[]': "Bedroom is required",
            neighborhood: "Neighborhood is required",
            first_name: "First name is required",
            last_name: "Last name is required",
            phone_number: "Phone number is required",
            email: {
                required: "Email is required",
                email: "Invalid email address"
            },
            description: "Description is required"
        }
    });

    // Listing Report Form
    $('#report_listing').validate({
        rules: {
            username: "required",
            email: {
                required: true,
                email: true
            },
            phone_number: "required",
            reason: "required",
            message: "required"
        },

        messages: {
            username: "User name is required",
            email: "Email is required",
            phone_number: "Phone number is required",
            reason: "Reason is required",
            message: "Message is required"
        }
    });

    // Let Us Help Form Validations
    $('#let_us_help').validate({
        rules:{
            budget: {
                required: true
            },
            location_preference: {
                required: true
            },
            username: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone_number: {
                required: true
            }
        },

        messages: {
            budget: 'Budget is required.'
        }
    })
});




























