# Cybehad

Cybehad is a Laravel application featuring a modern blog platform with Livewire Volt components, dark/light mode support, and an admin panel for managing posts, categories, and tags.

## Features

- Blog posts with categories, tags, images, and rich content
- SPA-like navigation using `wire:navigate` (Livewire v3+)
- Admin dashboard for post management (create, edit, delete, view)
- Dark/Light mode toggle for user interface
- File/image upload support for posts
- User authentication and authorization
- Post likes, ratings, and save/bookmark functionality
- Newsletter subscription and unsubscribe

## Tech Stack

- Laravel 10+
- Livewire & Livewire Volt
- Tailwind CSS (or Bootstrap, depending on your setup)
- Alpine.js (optional, for interactivity)
- MySQL or compatible database

## Setup

1. **Clone the repository**
    ```bash
    git clone https://github.com/your-username/cybehad.git
    cd cybehad
    ```

2. **Install dependencies**
    ```bash
    composer install
    npm install && npm run dev
    ```

3. **Configure environment**
    - Copy `.env.example` to `.env` and set your database and mail credentials.
    - Generate application key:
      ```bash
      php artisan key:generate
      ```

4. **Run migrations**
    ```bash
    php artisan migrate
    ```

5. **Seed the database (optional)**
    ```bash
    php artisan db:seed
    ```

6. **Start the development server**
    ```bash
    php artisan serve
    ```

7. **Access the app**
    - Visit [http://localhost:8000](http://localhost:8000) in your browser.

## Customization

- **Layouts:** You can customize the main layout in `resources/views/layouts/custom-layout.blade.php`.
- **Admin Panel:** Admin views are in `resources/views/livewire/admin/posts/`.
- **Dark/Light Mode:** Toggle is available on most pages; customize styles in your CSS or Tailwind config.

## Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.

## License

[MIT](LICENSE)

