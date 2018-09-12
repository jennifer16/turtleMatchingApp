from PIL import Image

inputName = sys.argv[1]

im = Image.open(inputName)
im.save(inputName)
