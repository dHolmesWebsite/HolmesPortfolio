/**
 * Theme Name: holmesportfolio
 * Theme URI: https://holmesportfolio.co.uk/
 * Description: A theme designed with accessibility in mind
 * Author: David Holmes
 * Author URI: https://holmesportfolio.co.uk/
 * Requires PHP: 7
 * Tested up to: 6.5
 * Version: 4.3
 * License: holmesportfolio Commercial License
 * License URI: https://holmesportfolio.co.uk/hwlicense
 * Text Domain: holmesportfolio
 *
 * @package holmesportfolio
 */

document.addEventListener("DOMContentLoaded", function () {
  jQuery(document).ready(function ($) {
    const commentForm = document.querySelector(".comment-form");

    if (commentForm) {
      const commentErrors = document.createElement("div");
      commentErrors.classList.add("comment-errors");
      commentForm.prepend(commentErrors);

      const fields = {
        author: {
          element: commentForm.querySelector("#author"),
          errorMessage: "Please enter your name.",
        },
        email: {
          element: commentForm.querySelector("#email"),
          errorMessage: "Please enter a valid email address.",
          validate: validateEmail,
        },
        comment: {
          element: commentForm.querySelector("#comment"),
          errorMessage: "Please enter your comment.",
        },
      };

      // Function clear existing errors
      function clearErrors() {
        Object.values(fields).forEach((field) => {
          if (field.element) {
            const errorElement = field.element.nextElementSibling;
            if (
              errorElement &&
              errorElement.classList.contains("error-message")
            ) {
              field.element.parentNode.removeChild(errorElement);
              field.element.removeAttribute("aria-describedby");
            }
          }
        });
      }

      // Function error message
      function showError(element, message) {
        const error = document.createElement("p");
        error.classList.add("error-message");
        error.style.color = "red";
        error.style.fontWeight = "bold";
        error.textContent = message;
        error.id = `${element.id}-error`;
        element.parentNode.appendChild(error);
        element.setAttribute("aria-describedby", error.id);
      }

      // Function validate email
      function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
      }

      // Add event listener for form submission
      commentForm.addEventListener("submit", function (event) {
        clearErrors();
        let hasError = false;

        Object.keys(fields).forEach((fieldKey) => {
          const field = fields[fieldKey];
          if (field.element) {
            const value = field.element.value;
            const isValid = field.validate ? field.validate(value) : value;

            if (!isValid) {
              hasError = true;
              showError(field.element, field.errorMessage);
            }
          }
        });

        if (hasError) {
          event.preventDefault();
        }
      });

      // Add event listener/clear errors on input
      Object.values(fields).forEach((field) => {
        if (field.element) {
          field.element.addEventListener("input", function () {
            const errorElement = field.element.nextElementSibling;
            if (
              errorElement &&
              errorElement.classList.contains("error-message")
            ) {
              field.element.parentNode.removeChild(errorElement);
              field.element.removeAttribute("aria-describedby");
            }
          });
        }
      });
    }
  });
});
