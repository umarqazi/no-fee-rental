"use strict"
$(()=>{$("body").find("input[value=Resend]").attr("disabled","disabled"),localStorage.getItem($("body").find("input[name=token]").val())?$("body").trigger("form-success-resend-email",{delay:localStorage.getItem($("body").find("input[name=token]").val())}):$("body").find("input[value=Resend]").removeAttr("disabled")}),$("body").on("form-success-resend-email",function(e,d){let t=$("input[value=Resend]");!$("body").find(".resend-delay").length>0&&setTimeout(()=>{t.before("<p class=resend-delay></p>")},10);let a=d.delay,n=setInterval(()=>{t.attr("disabled","disabled"),a-=1,localStorage.setItem($("body").find("input[name=token]").val(),a),$("body").find(".resend-delay").text(`You can resend email after ${a} seconds`)},1e3);setTimeout(()=>{localStorage.removeItem($("body").find("input[name=token]").val()),$("body").find(".resend-delay").remove(),t.removeAttr("disabled"),clearInterval(n)},1e3*a)});