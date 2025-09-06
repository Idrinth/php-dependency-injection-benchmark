# AGENTS

This repository contains PHP benchmark code. These instructions help maintain consistency.

## General Guidelines
- Use four spaces for indentation.
- Ensure files end with a newline.

## Testing
- When modifying PHP source files, run `php -l` on each changed file to verify syntax.
- No other automated tests are required.

## Workflow
- Merge raw benchmark JSON files using `php tools/merge_json.php`.
- Generate `run_summary.yaml` with `php tools/generate_run_summary.php`.
- Create PNG graphs from the consolidated results via `php tools/generate_graphs.php`.
- Regenerate the `README.md` using `php tools/generate_readme.php`.

## Tool Scripts
- `tools/merge_json.php`: combines individual run JSON files and computes summary statistics.
- `tools/generate_run_summary.php`: builds `run_summary.yaml` and archives it on scheduled runs.
- `tools/generate_graphs.php`: renders benchmark charts as PNG images.
- `tools/generate_readme.php`: updates the project README based on the latest results.
