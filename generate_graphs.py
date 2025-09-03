import matplotlib.pyplot as plt

containers = ['php-di', 'pimple', 'quickly-configured', 'quickly-reflection']
without_startup = [0.0009892463684082, 0.068728637695312, 0.003695821762085, 0.0038602352142334]
with_startup = [0.0011119842529297, 0.069630765914917, 0.0037338256835937, 0.0038558959960937]

def create_bar_chart(values, title, filename):
    plt.figure()
    plt.bar(containers, values)
    plt.ylabel('Seconds per 10000')
    plt.title(title)
    plt.tight_layout()
    plt.savefig(filename)

create_bar_chart(without_startup, 'Speed Comparison Without Startup Time', 'speed_comparison_without_startup.png')
create_bar_chart(with_startup, 'Speed Comparison With Startup Time', 'speed_comparison_with_startup.png')
