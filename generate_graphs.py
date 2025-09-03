import glob
import os
import re

import matplotlib.pyplot as plt

containers = sorted(
    os.path.splitext(os.path.basename(f))[0] for f in glob.glob("*.txt")
)
if not containers:
    raise RuntimeError("No benchmark result files found")

def extract_averages(filename):
    values = []
    pattern = re.compile(r"^[0-9.]+ \| [0-9.]+ \| [0-9.]+$")
    with open(filename) as f:
        for line in f:
            line = line.strip()
            if pattern.match(line):
                values.append(float(line.split('|')[0]))
    if len(values) < 2:
        raise ValueError(f"Expected two average lines in {filename}")
    return values[0], values[1]

without_startup = []
with_startup = []
for container in containers:
    wos, ws = extract_averages(f"{container}.txt")
    without_startup.append(wos)
    with_startup.append(ws)

def create_bar_chart(values, title, filename):
    plt.figure()
    plt.bar(containers, values)
    plt.ylabel('Seconds per 10000')
    plt.title(title)
    plt.tight_layout()
    plt.savefig(filename)

create_bar_chart(without_startup, 'Speed Comparison Without Startup Time', 'speed_comparison_without_startup.png')
create_bar_chart(with_startup, 'Speed Comparison With Startup Time', 'speed_comparison_with_startup.png')
