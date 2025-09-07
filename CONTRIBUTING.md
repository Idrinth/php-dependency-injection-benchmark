# Contributing

Thank you for your interest in contributing to the PHP Dependency Injection Benchmark project.

## Getting Started
1. Fork the repository and create a branch for your changes.
2. Follow the existing folder structure and naming conventions.
3. Use four spaces for indentation and ensure files end with a newline.

## Making Changes
- When modifying PHP source files, run `php -l` on each edited file to verify syntax.
- Generate derived artifacts when necessary:
    - `php tools/merge_json.php` to consolidate benchmark JSON results.
    - `php tools/generate_run_summary.php` for `run_summary.yaml`.
    - `php tools/generate_graphs.php` to update JPG charts.
    - `php tools/generate_readme.php` to refresh the README.
- Include related updates to tooling when documentation or generated files change.

## Submitting Changes
1. Commit your work with clear messages.
2. Open a pull request describing the changes and any relevant context.
3. Be prepared to address review feedback.

We appreciate your contributions!

