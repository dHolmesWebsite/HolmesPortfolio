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
let history = [];

/* hamburger menu */
document.addEventListener("DOMContentLoaded", function () {
  const menuToggle = document.querySelector(".menu-toggle");
  const navbar = document.querySelector(".navbar");

  if (menuToggle && navbar) {
    navbar.style.display = "none";
    menuToggle.addEventListener("click", function () {
      const isExpanded = navbar.style.display === "block";
      navbar.style.display = isExpanded ? "none" : "block";
      const ariaExpanded = menuToggle.getAttribute("aria-expanded") === "true";
      menuToggle.setAttribute("aria-expanded", !ariaExpanded);
      navbar.classList.toggle("expanded");
      resetMenu();
    });
  }

  function resetMenu() {
    history = [];
    // Hide all submenus
    const submenus = navbar.querySelectorAll(".sub-menu");
    submenus.forEach((submenu) => {
      submenu.style.display = "none";
    });

    // Restore all menu items
    const allMenuItems = navbar.querySelectorAll(".menu-item");
    allMenuItems.forEach((item) => {
      const anchor = item.querySelector("a");
      anchor.removeAttribute("aria-hidden");
      item.style.display = "block";
      anchor.classList.remove("centerParentText");
    });

    // Remove styles
    const centeredMenuItems = navbar.querySelectorAll(".menu-item");
    centeredMenuItems.forEach((item) => {
      uncenterParentChildren(item);
    });

    // Remove any back links
    const existingBackLink = navbar.querySelector(".back-link");
    if (existingBackLink) {
      existingBackLink.remove();
    }
  }
  resetMenu();
});

// uncenter current
function uncenterParentChildren(parentMenu) {
  const childMenuItems = parentMenu.querySelectorAll(".menu-item");
  childMenuItems.forEach((item) => {
    const anchor = item.querySelector("a");
    anchor.classList.remove("centerParentText");
  });
}

//navbar
document.addEventListener("DOMContentLoaded", function () {
  const navbar = document.querySelector(".navbar");

  function hideMenuItems(excludeItem) {
    const allMenuItems = navbar.querySelectorAll(".menu-item");

    allMenuItems.forEach((item) => {
      if (!item.classList.contains("home") && !item.contains(excludeItem)) {
        item.style.display = "none";
        item.removeAttribute("aria-hidden");
      }
    });

    const parentSubMenu = excludeItem.querySelector(".sub-menu");

    if (parentSubMenu) {
      parentSubMenu.querySelectorAll(".menu-item").forEach((item) => {
        item.style.display = "block";
        item.removeAttribute("aria-hidden");
      });
    }

    excludeItem.style.display = "block";
    excludeItem.removeAttribute("aria-hidden");
  }

  // center current
  function centerParentText(item) {
    const anchor = item.querySelector("a");
    anchor.classList.add("centerParentText");

    const menuItemHasChildren = item.classList.contains(
      "menu-item-has-children"
    );
    if (menuItemHasChildren) {
      const afterElement = anchor.nextElementSibling;
      if (afterElement && afterElement.tagName === "SPAN") {
        afterElement.remove();
      }
    }
  }

  // Used to return Navbar to normal
  function uncenterParentText() {
    const parentMenuItems = navbar.querySelectorAll(".menu-item");
    parentMenuItems.forEach((item) => {
      const anchor = item.querySelector("a");
      anchor.classList.remove("centerParentText");
    });
  }

  function createBackLink() {
    const backLink = document.createElement("a");
    backLink.href = "#";
    backLink.textContent = "← Back to Menu";
    backLink.classList.add("back-link");
    return backLink;
  }

  function showSubMenu(submenu) {
    submenu.style.display = "block";
    const parentMenu = submenu.closest(".menu-item");
    parentMenu.style.display = "block";
  }

  function hideSubMenu(submenu) {
    submenu.style.display = "none";
  }

  function restoreMenuItems() {
    const directChildren = navbar.querySelectorAll(":scope > .menu-item");

    directChildren.forEach((item) => {
      item.style.display = "none";
      item.removeAttribute("aria-hidden");
    });

    if (history.length > 0) {
      const currentSubMenu = history[history.length - 1];
      const parentMenu = currentSubMenu.closest(".menu-item");

      if (parentMenu) {
        parentMenu.style.display = "block";
        const parentSubMenu = parentMenu.querySelector(".sub-menu");

        if (parentSubMenu) {
          parentSubMenu.querySelectorAll(".menu-item").forEach((item) => {
            item.style.display = "block";
            item.removeAttribute("aria-hidden");
          });
        }

        centerParentText(parentMenu);
        uncenterParentChildren(parentMenu);
      }
    } else {
      uncenterParentText();
      const allMenuItems = navbar.querySelectorAll(".menu-item");
      allMenuItems.forEach((item) => {
        if (!item.classList.contains("home")) {
          item.style.display = "block";
          const anchor = item.querySelector("a");
          anchor.removeAttribute("aria-hidden");
        }
      });
    }
  }

  navbar.addEventListener("click", function (event) {
    const target = event.target;
    if (
      target.tagName === "A" &&
      target.parentNode.classList.contains("menu-item-has-children")
    ) {
      const submenu = target.nextElementSibling;
      // add history
      history.push(submenu);
      hideMenuItems(target.parentNode);
      showSubMenu(submenu);
      centerParentText(target.parentNode);

      const existingBackLink = navbar.querySelector(".back-link");
      if (existingBackLink) {
        existingBackLink.remove();
      }

      const backLink = createBackLink();
      submenu.insertBefore(backLink, submenu.firstElementChild);
      event.preventDefault();
    }

    if (target.classList.contains("back-link")) {
      // Remove submenu from history
      const previousSubMenu = history.pop();

      if (previousSubMenu) {
        hideSubMenu(previousSubMenu);
        restoreMenuItems();

        const existingBackLink = navbar.querySelector(".back-link");
        if (existingBackLink) {
          existingBackLink.remove();
        }

        // create back link if submenu
        if (history.length > 0) {
          const backLink = createBackLink();
          history[history.length - 1].insertBefore(
            backLink,
            history[history.length - 1].firstElementChild
          );
        }
      } else {
        restoreMenuItems();
      }

      event.preventDefault();
    }
  });
});
