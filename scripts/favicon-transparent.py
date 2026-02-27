#!/usr/bin/env python3
"""Make favicon background transparent (white/near-white -> alpha 0)."""
import sys
import os

# Allow using Pillow from project vendor
sys.path.insert(0, os.path.join(os.path.dirname(__file__), '..', 'vendor-pillow'))
from PIL import Image

def main():
    script_dir = os.path.dirname(os.path.abspath(__file__))
    project = os.path.dirname(script_dir)
    src = os.path.join(project, 'public', 'assets', 'images', 'favicon.JPG')
    out = os.path.join(project, 'public', 'assets', 'images', 'favicon-transparent.png')

    img = Image.open(src).convert('RGBA')
    data = img.getdata()
    new_data = []
    # Anggap background: putih atau sangat terang (threshold)
    threshold = 245  # R, G, B >= threshold -> transparan
    for item in data:
        r, g, b, a = item
        if r >= threshold and g >= threshold and b >= threshold:
            new_data.append((255, 255, 255, 0))
        else:
            new_data.append(item)
    img.putdata(new_data)
    img.save(out, 'PNG')
    print(out)
    return 0

if __name__ == '__main__':
    sys.exit(main())
