<?php
/**
 *
 *
 * @param array $clean_inputs
 * @return string
 */
function game(array $clean_inputs, int $roll): bool {
    $_SESSION['play']++;

    switch ($clean_inputs['select']) {
        case 'cof_1':
            $result = $roll % 2 === 0;
            $win_amount = $clean_inputs['bet_amount'] * 0.5;
            break;
        case 'cof_2':
            $result = $roll % 2 !== 0;
            $win_amount = $clean_inputs['bet_amount'] * 0.5;
            break;
        case 'cof_3':
            $result = $roll === 1;
            $win_amount = $clean_inputs['bet_amount'] * 2;
            break;
        case 'cof_4':
            $result = $roll === 6;
            $win_amount = $clean_inputs['bet_amount'] * 2;
            break;
    }

    if ($result) {
        $_SESSION['cash'] += $win_amount;
    } else {
        $_SESSION['cash'] -= $clean_inputs['bet_amount'];
    }

//    Įrašo vartojo duomeni į duomenų bazę

    $data = file_to_array(DB_FILE);
    foreach ($data as &$player) {
        if ($player['email'] === $_SESSION['email']) {
            $player['cash'] = $_SESSION['cash'];
            $player['play'] = $_SESSION['play'];
            array_to_file($data, DB_FILE);
        }
    }

    return $result;
}
