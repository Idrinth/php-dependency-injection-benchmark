import glob
import json
import os

import matplotlib.pyplot as plt


def format_name(name: str) -> str:
    if "." in name:
        first, rest = name.split(".", 1)
        return f"{first}\n({rest})"
    return name


containers = sorted(
    os.path.splitext(os.path.basename(f))[0] for f in glob.glob("*.json")
)
if not containers:
    raise RuntimeError("No benchmark result files found")
display_names = [format_name(c) for c in containers]

def extract_averages(filename):
    with open(filename) as f:
        data = json.load(f)
    return data["z26"]["average"], data["z26_startup"]["average"]

without_startup = []
with_startup = []
for container in containers:
    wos, ws = extract_averages(f"{container}.json")
    without_startup.append(wos)
    with_startup.append(ws)


def create_bar_chart(values, title, filename):
    plt.figure()
    plt.bar(display_names, values)
    plt.ylabel("Seconds per 10000")
    plt.title(title)
    plt.yscale("log")
    plt.tight_layout()
    plt.savefig(filename)

create_bar_chart(without_startup, 'Speed Comparison Without Startup Time', 'speed_comparison_without_startup.png')
create_bar_chart(with_startup, 'Speed Comparison With Startup Time', 'speed_comparison_with_startup.png')
