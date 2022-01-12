export default function base64File(dataURL = '') {

  if (dataURL.trim().length === 0) {
    throw new Error('required data url base 64');
  }

  let array = [];
  let binary = atob(dataURL.split(',')[1]);
  const type = dataURL.split(',')[0].split(':')[1].split(';')[0];
  const ext = type.split('/')[1];
  array = [];

  let it = 0;
  while (it < binary.length) {
    array.push(binary.charCodeAt(it));
    it++;
  }
  const blob = new Blob([new Uint8Array(array)], {
    type
  });

  return new File([blob], `image.${ext}`, {
    type
  });
}
