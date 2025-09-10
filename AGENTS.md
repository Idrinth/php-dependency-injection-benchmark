# AGENTS

This repository contains PHP benchmark code. These instructions help maintain consistency.

## General Guidelines
- Use four spaces for indentation.
- Ensure files end with a newline.
- Do not commit binary files such as images; generate them as needed outside of version control.

## Folder Naming
- Use lowercase letters with hyphens to separate words.
- Store source code under `src`, tooling in `tools`, and generated media in `images`.
- Archive benchmark outputs in `archive/YYYY-MM-DD` directories to maintain chronological order.
- Avoid spaces, camelCase, or underscores in directory names.

## Testing
- When modifying PHP source files, run `php -l` on each changed file to verify syntax.
- No other automated tests are required.

## Workflow
- Merge raw benchmark JSON files using `php tools/merge_json.php`.
- Generate `run_summary.yaml` with `php tools/generate_run_summary.php`.
- Create JPG graphs from the consolidated results via `php tools/generate_graphs.php`.
- Regenerate the `README.md` using `php tools/generate_readme.php`.
- Ensure any changes to `README.md` are also applied in `tools/generate_readme.php`.

## Tool Scripts
- `tools/merge_json.php`: combines individual run JSON files and computes summary statistics.
- `tools/generate_run_summary.php`: builds `run_summary.yaml` and archives it on scheduled runs.
- `tools/generate_graphs.php`: renders benchmark charts as JPG images.
- `tools/generate_readme.php`: updates the project README based on the latest results.

## Data Management
- Version Tracking: document how dependency versions are extracted and recorded in `run_summary.yaml`.
- Monthly Archival: detail the process for archiving results in `archive/YYYY-MM-DD` directories.
- Result Validation: outline steps to ensure benchmark data integrity and handle edge cases such as timeouts and errors.

## Development Standards
- Bias Awareness: Special considerations for the "quickly" container (author conflict of interest)
- Reproducibility: Ensuring consistent environments across different runs
- Container Isolation: Each container should be completely independent
