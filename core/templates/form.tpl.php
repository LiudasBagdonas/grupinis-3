<form <?php print form_attr($form); ?>>
    <?php foreach ($form['fields'] as $input_name => $input) : ?>
        <label>
            <p class="label_text"><?php print $input['label']; ?></p>
            <?php if ($input['type'] === 'select') : ?>
                <select <?php print select_attr($input_name, $input); ?>>
                    <?php foreach ($input['options'] as $option_name => $option_value) : ?>
                        <option <?php print option_attr($option_name, $input); ?>>
                            <?php print $option_value; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php elseif ($input['type'] === 'textarea') : ?>
                <textarea <?php print textarea_attr($input_name, $input); ?>><?php print $input['value']; ?></textarea>
            <?php else : ?>
                <input <?php print input_attr($input_name, $input); ?>>
            <?php endif; ?>
            <?php if (isset($input['error'])) : ?>
                <p class="error"><?php print $input['error']; ?></p>
            <?php endif; ?>
        </label>
    <?php endforeach; ?>

    <?php foreach ($form['buttons'] as $button_id => $button) : ?>
        <button <?php print button_attr($button_id, $button); ?>>
            <?php print $button['title']; ?>
        </button>
    <?php endforeach; ?>

    <?php if (isset($form['error'])) : ?>
        <p class="error"><?php print $form['error']; ?></p>
    <?php endif; ?>
</form>