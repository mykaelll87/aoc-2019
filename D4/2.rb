def isValid (n)
    s = n.to_s
    chars = {s[s.length-1]=>1}
    for i in 0..(s.length-2) do
        chars[s[i]] = (chars[s[i]] || 0).next
        if s[i]> s[i+1]
            return false
        end
    end

    return chars.any?{|k,v| v==2}
end

sum = 0
for i in (284639..748759) do
    if isValid(i)
        sum = sum.next
    end
end

print sum