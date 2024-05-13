# Big JSON

Read and Write a big json.

## Reading Time Comparations

This reading method is using custom php function named `read_json_file` build using Rust and read using json-machine library and `simdjson_decode` using foreach-loop

| Filezie      | Filename              | JSON Machine     | simdjson_decode  |
| ------------ | --------------------- | ---------------- | ---------------- |
| 85M          | 100-000-data.json     | 12.258496999741  | 1.2215161323547  |
| 169M         | 200-000-data.json     | 22.948163986206  | 3.7172930240631  |
| 422M         | 500-000-data.json     | 70.838052034378  | 7.4947230815887  |
| 674M         | 800-000-data.json     | 97.320855855942  | 13.613089084625  |
| 843M         | 1-000-000-data.json   | 120.48568701744  | 18.800848960876  |
| 1,3G         | 1-500-000-data.json   | 172.90668702126  | 172.90668702126  |

