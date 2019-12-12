def isValid (n)
    s = n.to_s
    doubled = false
    for i in 0..(s.length-2) do
        if !doubled && s[i]==s[i+1]
            doubled = true
        end
        if s[i]> s[i+1]
            return false
        end
    end

    return doubled
end

sum = 0
for i in (284639..748759) do
    if isValid(i)
        sum = sum.next
    end
end

print sum