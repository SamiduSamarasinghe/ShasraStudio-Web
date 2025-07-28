document.addEventListener("DOMContentLoaded", function () {
  const sidebarItems = document.querySelectorAll(".sidebar .item a");
  const contents = document.querySelectorAll(".content");
  const mainDashboard = document.querySelector(".dashboard");

  sidebarItems.forEach((item) => {
    item.addEventListener("click", function (event) {
      event.preventDefault();
      const targetId = item.getAttribute("href").replace("#", "");

      // Hide main dashboard content
      if (mainDashboard) {
        mainDashboard.style.display = "none";
      }

      // Show only the target content and hide others
      contents.forEach((content) => {
        if (content.id === targetId) {
          content.style.display = "block";
        } else {
          content.style.display = "none";
        }
      });
    });
  });
});

// Other JavaScript code for handling sidebar and charts
const sidebar = document.querySelector(".sidebar");
const sidebarClose = document.querySelector("#sidebar-close");
const menu = document.querySelector(".menu-content");
const menuItems = document.querySelectorAll(".submenu-item");
const subMenuTitles = document.querySelectorAll(".submenu .menu-title");

sidebarClose.addEventListener("click", () => sidebar.classList.toggle("close"));

menuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    menu.classList.add("submenu-active");
    item.classList.add("show-submenu");
    menuItems.forEach((item2, index2) => {
      if (index !== index2) {
        item2.classList.remove("show-submenu");
      }
    });
  });
});

subMenuTitles.forEach((title) => {
  title.addEventListener("click", () => {
    menu.classList.remove("submenu-active");
  });
});

// Account Overview Chart
const ctx1 = document
  .querySelector(".account-overview .chart")
  .getContext("2d");
new Chart(ctx1, {
  type: "pie",
  data: {
    labels: ["Renting", "Booking", "Orders", "Others"],
    datasets: [
      {
        data: [25, 20, 40, 15],
        backgroundColor: ["#ff6384", "#36a2eb", "#ffce56", "#4bc0c0"],
      },
    ],
  },
});

// Activity Chart
const ctx2 = document.querySelector(".activity .chart").getContext("2d");
new Chart(ctx2, {
  type: "line",
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
    datasets: [
      {
        label: "Activity",
        data: [30, 70, 55, 80, 60, 90, 75],
        borderColor: "#36a2eb",
        backgroundColor: "rgba(54, 162, 235, 0.2)",
        fill: true,
      },
    ],
  },
});

// Spending Chart
const ctx3 = document.querySelector(".spending .chart").getContext("2d");
new Chart(ctx3, {
  type: "doughnut",
  data: {
    labels: ["Groceries", "Utilities", "Entertainment", "Miscellaneous"],
    datasets: [
      {
        data: [30, 20, 25, 25],
        backgroundColor: ["#ff6384", "#36a2eb", "#ffce56", "#4bc0c0"],
      },
    ],
  },
});

// Transaction Overview Chart
const ctx4 = document
  .querySelector(".transaction-overview .graph")
  .getContext("2d");
new Chart(ctx4, {
  type: "bar",
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
    datasets: [
      {
        label: "Transactions",
        data: [50, 60, 70, 80, 60, 70, 90],
        backgroundColor: "#ff6384",
      },
    ],
  },
});

document.addEventListener("DOMContentLoaded", () => {
  const applicationList = document.querySelector(".application-list tbody");

  applicationList.addEventListener("change", (event) => {
    if (event.target.tagName === "SELECT") {
      const action = event.target.value;
      const row = event.target.closest("tr");
      const statusCell = row.querySelector(".status");

      if (action === "approve") {
        statusCell.textContent = "Approved";
        statusCell.className = "status approved";
      } else if (action === "deny") {
        statusCell.textContent = "Denied";
        statusCell.className = "status denied";
      }

      event.target.value = "action";
    }
  });
});

document
  .getElementById("pay-salaries-form")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    const designation = document.getElementById("designation").value;
    const name = document.getElementById("name").value;
    const salaryAmount = document.getElementById("salary-amount").value;

    console.log(`Designation: ${designation}`);
    console.log(`Name: ${name}`);
    console.log(`Salary Amount: ${salaryAmount}`);

    alert("Salary payment processed!");
  });

sidebarClose.addEventListener("click", () => {
  sidebar.classList.toggle("show");
});

document.querySelectorAll(".menu-items a").forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    const targetId = this.getAttribute("href").substring(1);
    const targetElement = document.getElementById(targetId);
    if (targetElement) {
      document
        .querySelectorAll(".content")
        .forEach((content) => content.classList.remove("show-content"));
      targetElement.classList.add("show-content");
    }
  });
});

const form = document.querySelector("form"),
  nextBtn = form.querySelector(".nextBtn"),
  backBtn = form.querySelector(".backBtn"),
  allInput = form.querySelectorAll(".first input");
nextBtn.addEventListener("click", () => {
  allInput.forEach((input) => {
    if (input.value != "") {
      form.classList.add("secActive");
    } else {
      form.classList.remove("secActive");
    }
  });
});
backBtn.addEventListener("click", () => form.classList.remove("secActive"));

document.addEventListener("DOMContentLoaded", function () {
  const sidebar = document.querySelector(".sidebar");
  const submenuItems = document.querySelectorAll(".submenu-item");
  const closeSidebar = document.querySelector("#sidebar-close");

  submenuItems.forEach((item) => {
    item.addEventListener("click", () => {
      item.nextElementSibling.classList.toggle("submenu-active");
    });
  });

  closeSidebar.addEventListener("click", () => {
    sidebar.classList.toggle("close");
  });

  const menuLinks = document.querySelectorAll(".item a, .submenu .item a");
  const contents = document.querySelectorAll(".content");

  menuLinks.forEach((link) => {
    link.addEventListener("click", (event) => {
      event.preventDefault();
      const targetId = link.getAttribute("href").substring(1);
      contents.forEach((content) => {
        content.style.display = content.id === targetId ? "block" : "none";
      });
    });
  });
});

// Sidebar toggle for small screens
document.getElementById("sidebar-close").addEventListener("click", function () {
  document.querySelector(".sidebar").classList.toggle("show");
});

// Submenu toggle
document.querySelectorAll(".submenu-item").forEach((item) => {
  item.addEventListener("click", function () {
    this.nextElementSibling.classList.toggle("show");
  });
});

// Handling clicks on sidebar links to navigate to respective sections
document.querySelectorAll(".sidebar a").forEach((link) => {
  link.addEventListener("click", function (event) {
    event.preventDefault();
    const targetId = this.getAttribute("href").substring(1);
    document.querySelectorAll("main .content").forEach((section) => {
      section.style.display = section.id === targetId ? "block" : "none";
    });
  });
});

// Displaying the first section by default
document.addEventListener("DOMContentLoaded", function () {
  document.querySelector("main .content").style.display = "block";
});

function openModal(event) {
  event.preventDefault(); // Prevent the form from submitting
  document.getElementById("modal").style.display = "block";
}

function closeModal() {
  document.getElementById("modal").style.display = "none";
}

// Close the modal if the user clicks outside of it
window.onclick = function (event) {
  if (event.target == document.getElementById("modal")) {
    closeModal();
  }
};
