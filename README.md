# codeception-data-selector
A Codeception extension to automatically select data from DB based on certain conditions.

## Usage

Update your `codeception.yml`:

    extensions:
      enabled:
        - \Alpha1_501st\CodeceptionDataSelector\DataSelector
      config:
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

This will produce the following SQL query:

    SELECT content FROM comments
      LEFT JOIN users ON comments.user_id = users.id
      WHERE users.activated = 1 LIMIT 1;

In your test classes, do:

    $data = \Alpha1_501st\CodeceptionDataSelector\DataFactory::make();

And then you can access the `content` field from above via. `$data->var1->content`.
