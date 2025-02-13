# Laravel Project Setup

## Installation Steps

1. Install dependencies using Composer:
   ```sh
   composer install
   ```

2. Copy the environment file:
   ```sh
   cp .env.example .env
   ```

3. Generate the application key:
   ```sh
   php artisan key:generate
   ```

Now your Laravel project is ready for further setup and configuration!

---

# SQL Improvement Logic Test

1. **Create Indexing:** Add indexing for columns in the tables `job`, `job_types`, and `jobs_categories` to optimize query performance.
2. **Optimize Joins:** Remove unnecessary or redundant `LEFT JOIN` tables to improve query execution time.
3. **Use Indexed Pagination:** Implement pagination based on the indexed columns from the three tables to enhance efficiency and reduce load time.

