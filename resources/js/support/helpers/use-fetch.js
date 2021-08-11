
export default function useFetch(url, options) {
  // execute before start fetcihng..
  options?.beforeStart();

  return axios.get(url)
    .then(res => res)
    .catch(err => {
      throw new Error(err);
    });
}
