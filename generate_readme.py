#!/usr/bin/env python3
import yaml


def format_name(name: str) -> str:
    if "." in name:
        first, rest = name.split(".", 1)
        return f"{first}({rest})"
    return name


with open("run_summary.yaml") as f:
    data = yaml.safe_load(f)

lines: list[str] = []
lines.append("# PHP Dependency Injection Benchmark")
lines.append("")
lines.append("This repository benchmarks different dependency injection containers.")
lines.append("")
php_version = data.get("php_version")
if php_version:
    lines.append(f"Tested with PHP {php_version}.")
    lines.append("")

dep_versions = data.get("dependency_versions", {})
if dep_versions:
    lines.append("## Dependency Versions")
    lines.append("")
    for container, deps in dep_versions.items():
        lines.append(f"- **{format_name(container)}**")
        for dep, version in deps.items():
            lines.append(f"  - `{dep}`: `{version}`")
        lines.append("")

results = data.get("results", {})
if results:
    lines.append("## Summary")
    lines.append("")
    lines.append("| Container | Average | Minimum | Maximum |")
    lines.append("| --- | --- | --- | --- |")
    for container, stats in results.items():
        lines.append(
            f"| {format_name(container)} | {stats['average']} | {stats['minimum']} | {stats['maximum']} |"
        )
    lines.append("")

lines.append("![Speed comparison without startup time](speed_comparison_without_startup.png)")
lines.append("")
lines.append("![Speed comparison with startup time](speed_comparison_with_startup.png)")
lines.append("")

with open("README.md", "w") as f:
    f.write("\n".join(lines))
