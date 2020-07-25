{!! HTML::style('usernoise/css/usernoise.css') !!}
<script type='text/javascript'>
    <!-- This data is used to configure Usernoise during bootstrap -->
    /* <![CDATA[ */
    var usernoise = {
        "i18n": { // Edit the strings below if you want to translate Usernoise
            "Leave a feedback": "Feedback",
            "Enter your feedback here": "Enter your feedback here",
            "Next": "Next",
            "Taking screenshot": "Taking screenshot",
            "Take a screenshot": "Take a screenshot",
            "screenshot.png": "screenshot.png",
            "Cancel": "Cancel",
            "Add some details": "Details",
            "Back": "Back",
            "Submit": "Submit",
            "Submitting": "Submitting",
            "Error sending feedback": "Error sending feedback",
            "Close": "Close",
            "OKText": "Your feedback was submitted successfully",
            "Done": "Done",
            "Please enter a valid email address": "Please enter a valid email address",
            "This field is required": "This field is required"
        },
        "config": {
            "button": {
                "enabled": true,
                "disableOnMobiles": false, // If the button should be disabled on small screen devices
                "text": "Feedback", // Button text
                "style": "background-color: #404040; color: #FFFFFF", // Button CSS style
                "class": "un-left" // Button class. Available ones are un-left, un-right, un-bottom, un-top
            },

            // Usernoise URLs. Please only change if you know what you're doing
            "urls": {
                "feedback": {post: "{{ route('feedback.send') }}"},
                "usernoise": "/usernoise/",
                "html2canvasproxy": "/usernoise/proxy.php"
            },
            screenshot: {enable: true},
            // Form fields
            "form": {
                "fields": {
                    "email": {
                        "type": "email", // Available types - text, email, dropdown
                        "label": "Email address", //label displayed next to the field
                        "placeholder": "you@example.com", // Placeholder displayed by default
                        "validators": ["email"] // Validator rules applied. Available ones - 'email', 'presence'
                    },
                    "summary": {
                        "type": "text",
                        "label": "Summary",
                        "placeholder": "Short summary",
                        "validators": ["required"]
                    },
                    "type": {
                        "type": "dropdown",
                        "label": "Feedback type",
                        "default": null,
                        "default_text": "Please select", // Text displayed when no value is selected
                        "options": { // Option definitions
                            "idea": "Idea",
                            "question": "Question",
                            "problem": "Problem",
                            "praise": "Praise"
                        },
                        "validators": ['required']
                    },
                    "mood": {
                        type: "dropdown",
                        label: 'How are you feeling?',
                        default: null,
                        default_text: 'Please select',
                        "options": {
                            "excited": "Excited!",
                            "happy": "Happy",
                            "confused": "Confused",
                            "worried": "Worried",
                            "frustrated": "Frustrated",
                            "angry": "Angry"
                        },
                        "validators": ['required']

                    }

                }
            },
        },
    };
    /* ]]> */
</script>
{!! HTML::script('usernoise/js/usernoise.js') !!}
<!-- end of Usernoise code -->