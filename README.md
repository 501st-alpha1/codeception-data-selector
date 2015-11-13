# codeception-data-selector
A Codeception extension to automatically select data from DB based on certain conditions.

## Usage

### Basic

Update your `codeception.yml`:

```yaml
extensions:
  enabled:
    - \Alpha1_501st\CodeceptionDataSelector\DataSelector
  config:
    dsn: 'mysql:host=localhost;dbname=testdb'
    user: 'root'
    password: ''
    data:
      var1:
        table: 'comments'
        fields:
          - content
        joins:
          users:
            - comments.user_id
            - users.id
        conditions:
          users.activated: '1'
```

This will produce the following SQL query:

```sql
SELECT content FROM comments
  LEFT JOIN users ON comments.user_id = users.id
  WHERE users.activated = 1 LIMIT 1;
```

In your test classes, do:

```php
$data = \Alpha1_501st\CodeceptionDataSelector\DataFactory::make();
```

And then you can access the `content` field from above via. `$data->var1->content`.

### Custom Operators

To use a custom comparison operator, instead of `=`, do e.g.:

```yaml
conditions:
  users.deleted_at:
    - 'IS NOT'
    - 'NULL'
```

This produces:

```sql
WHERE users.deleted_at IS NOT NULL
```
