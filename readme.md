# SmolBiz - Small Business Management

SmolBiz is a lightweight application designed to help small businesses efficiently manage their invoices and customer information.

## Features

*   **Invoice Management:** Create, track, and manage invoices for your customers.
*   **Customer Database:** Maintain a centralized database of your customer information.
*   **Reporting (Coming Soon):** Generate basic reports on sales and customer activity.

## Getting Started

### Prerequisites

*   [Node.js](https://nodejs.org/en/) (LTS version recommended)
*   [npm](https://www.npmjs.com/) (usually comes with Node.js)

### Installation

1.  **Clone the repository:**

    ```bash
    git clone https://github.com/your-username/smolbiz.git
    cd smolbiz
    ```

2.  **Install dependencies:**

    ```bash    
    cp .env.example .env
    ```

4.  **Generate application key:**

    ```bash
    php artisan key:generate
    ```

5.  **Run database migrations:**

    ```bash
    php artisan migrate
    ```

6.  **Install Composer dependencies:**

    ```bash
    composer install
    
    npm install
    ```

### Running the Application

To start the development server:

```bash
npm run prod
php artisan serve
```

This will typically open the application in your default web browser at `http://localhost:8000`.

## Usage

(Detailed usage instructions will be added here as the application develops.)

## Contributing

We welcome contributions! If you'd like to contribute, please follow these steps:

1.  Fork the repository.
2.  Create a new branch (`git checkout -b feature/your-feature-name`).
3.  Make your changes.
4.  Commit your changes (`git commit -m 'Add some feature'`).
5.  Push to the branch (`git push origin feature/your-feature-name`).
6.  Open a Pull Request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact

If you have any questions or feedback, please open an issue on GitHub.
