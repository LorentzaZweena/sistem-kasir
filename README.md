# Cashier System

This repository contains a PHP-based cashier system integrated with a MySQL database. The system manages various operations related to product sales, including customer information, product selection, and transaction processing. The project utilizes AJAX for seamless data updates and Bootstrap for a responsive design.

## Features

- **Customer Management:** Input and manage customer details.
- **Product Selection:** Dropdown menus for selecting products from the database.
- **Real-time Updates:** AJAX integration for automatic updates of dropdown lists and total calculations.
- **Transaction Records:** Store and display transaction records in a tabular format.
- **Responsive Design:** Bootstrap for a mobile-friendly interface.

## Project Structure

```
cashier/
│
├── db/
│   └── sistem_kasir.sql         # SQL dump for the database structure and initial data
│
├── src/
│   ├── index.php                # Main file displaying the table with transaction records
│   ├── sistem_kasir.php         # Script for managing the cashier system
│   ├── form.php                 # Form for inputting new data
│   ├── update.php               # PHP script for handling AJAX updates
│   └── js/
│       └── main.js              # JavaScript for handling form interactions and calculations
│
├── css/
│   └── styles.css               # Custom styles for the project
│
├── README.md                    # This README file
├── .gitignore                   # Git ignore file
└── LICENSE                      # License for the project
```

## Installation

1. **Clone the Repository:**
    ```sh
    git clone https://github.com/LorentzaZweena/sistem_kasir.git
    ```

2. **Import the Database:**
    - Import `sistem_kasir.sql` from the `db` directory into your MySQL database.

3. **Configure Database Connection:**
    - Update the database connection details in `sistem_kasir.php` and other PHP files as necessary.

4. **Start the Server:**
    - Ensure your web server is running (e.g., Apache, Nginx) and navigate to the project directory in your browser.

## Usage

- **Adding New Transactions:**
    - Use the form in `form.php` to input new customer details and select products.
    - The 'Tanggal' field will auto-fill with the current date.
    - 'Spending Total', 'Each Total', and 'Grand Total' are automatically calculated using JavaScript.

- **Updating Transactions:**
    - Changes to the dropdown lists and QTY fields in the main table will automatically update the database via AJAX.

## Contributing

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/YourFeature`).
3. Commit your changes (`git commit -am 'Add new feature'`).
4. Push to the branch (`git push origin feature/YourFeature`).
5. Create a new Pull Request.

## License

This project is licensed under the MIT License. See the LICENSE file for more information.

## Acknowledgments

- [Bootstrap](https://getbootstrap.com/)
- [jQuery](https://jquery.com/)
- [PHP](https://www.php.net/)
- [MySQL](https://www.mysql.com/)

## Contact

For any inquiries or support, please contact [ariva02zweena@gmail.com].

----
