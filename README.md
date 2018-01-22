# CriDe
a cryptography algorithm, implemented on a PHP server<br>

Cride
MatteoBavecchi

Introduction:

CriDe is very simple to use: just go to http://illuminismo.zz.mu/cride.
When we are in CriDe's home we have to select the file to be encrypted, choose
a complicated password, select the mode (which can be 'encrypt' or
'Decrypt'). After that we just have to click on 'elaborate'.
If everything is successful, the download of the processed text file will start automatically.

If you forget your password it is almost impossible to go back to the text, as it will be illegible.

Operation:

When the password is chosen, it is fragmented into characters, then into numbers,
and then in bits.

Password: dog.
c = 1100011<br>
a = 1100001<br>
n = 1101110<br>
e = 1100101<br>
<br>
<br>
Subsequently the xor (or-exclusive) operation is performed two by two, up to a single bit string.
<br>
XOR:<br>
a b x<br>
0 0 0<br>
0 1 1<br>
1 0 1<br>
1 1 0<br>
<br>
<br>
Why was the xor operation used instead of another? (And, or, etc.)
Because the xor is the only reversible, but we'll see it later.
<br>
So this happens:
<br>
'c' 1100011 ^ 1100001 = 0000010<br>
'n' 1101110 ^ 0000010 = 1101100<br>
'e' 1100101 ^ 1101100 = 0001001 this will be our mask.<br>
<br>
After having obtained the mask, obtained from the chosen password, we are going to apply it to
all the characters encoded in binary of the document to be encrypted:
<br>
Example:<br>
character to be encrypted: 'c'<br>
<br>
'c' 1100011 ^ 0001001 = 1101010 equivalent to the ascii j character.<br>

When we have the coded character, we convert it into ASCII character.
In short, if we want to encrypt 'c' with the password "dog", CriDe will return '
the character 'j'.
How do I get back to 'c'? easy, just do the xor of the mask with the binary of 'j':

'j' 1101010 ^ 0001001 = 1100011 equivalent to the ascii character c.

This is CriDe's cryptographic mode.



Problems and solutions:

In the ASCII table, the first 31 characters are not viewable, but they are special characters that act on the text file (for example '2' means "Start of Text",
'8' "backspace"), they are called control characters.
when you are going to apply a mask to a character, it can happen to have like
result a binary string corresponding to one of these 31 strange characters.
So I tricked the problem by adding 32 to all the numbers less than 32.
Then in the phase of decrypting I removed 32 to all those numbers that returned less than 32 s
he was removed 32.


Limitations:
Why did I encode 7-bit characters instead of 8-bit characters?
because if I had done that, there would have been numbers after 127, which characters
Correspondents are not well interpreted by the notepad, or interpreted differently
depending on o.s. used.

Author: Matteo Bavecchi

